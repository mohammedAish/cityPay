<?php

namespace App\Http\Controllers\Api\Wallet;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\WalletTrait;
use App\Http\Requests\InternalWithdrawRequest;
use App\Http\Resources\DepositOrderResource;
use App\Models\DepositAgency;
use Illuminate\Http\Request;

class InternalWithdrawApiController extends BaseApiController
{
    use WalletTrait;

    public function __construct(Request $request){
        parent::__construct($request);
        $this->base_data['instructions'] = $this->getServiceInstructions(3);
    }

    /**
     * لعرض الحسابات المالية للعميل لاختيار احدها في طلب السحب
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Support\Collection
     */
    public function listFinanceAccounts(){
        $this->base_data['accounts'] = $this->getCustomerFinanceAccounts(auth()->id());

        return $this->success_response($this->base_data,tt('you_get_finance_accounts'));
    }


    public function getWithdrawPercent($amount = 0,$agency_id = 0){
        $info    = DepositAgency::find($agency_id);
        $percent = $info->withdraw_fee_percent;
        $percent = ($amount * $percent) + $info->fixed_charge_withdraw;
        return $this->success_response(['percent' => $percent],'you get percent');
    }

    /**
     * will confirm the internal withdraw order as once
     * @@bodyParam  agency_id int required
     * @@bodyParam  amount int required
     * @@bodyParam  currency_id int required
     * @decription_info
     *
     * @param  InternalWithdrawRequest  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function confirmInternalWithdraw(InternalWithdrawRequest $request){
        if (!self::checkUserBalanceForInternalWithdraw($request->all(), auth()->user())) {
            return $this->fail_response(config('err_codes.data_not_update'),
                tt('we_cant_create_order').tt('لا يوجد رصيد كافي لسحب هذا المبلغ '));

        }
        $createdOrder = self::createInternalWithdrawOrder($request->all(),auth()->id(),
            auth()->user()->country_code);
        //real withdraw will be in admin
        if (!$createdOrder || !$createdOrder->id) {
            return $this->fail_response(config('err_codes.data_not_update'),
                tt('we_cant_create_order').tt('there are in posted data '));
        }

        return $this->success_response($createdOrder,tt('your_order_created_success'));
    }


    public function listInternalWithdrawOrders(Request $request){
        $orderStatus           = ($request->filled('status'))? $request->status :null;
        $listInternalWithdraws = $this->getWithdrawOrders(auth()->id(),$orderStatus);
        $listInternalWithdraws = DepositOrderResource::collection($listInternalWithdraws);

        return $this->success_response($listInternalWithdraws,tt('you_get_order_list'));
    }
}
