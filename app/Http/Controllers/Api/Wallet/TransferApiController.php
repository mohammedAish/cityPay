<?php

namespace App\Http\Controllers\Api\Wallet;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\WalletTrait;
use App\Http\Requests\TransferOrderRequest;
use App\Http\Resources\CountryResource;
use App\Http\Resources\ReceivingAgencyResource;
use App\Http\Resources\TransferWithdrawOrderResource;
use Illuminate\Http\Request;

class TransferApiController extends BaseApiController
{
    use WalletTrait;

    public function __construct(Request $request){
        parent::__construct($request);
        $this->base_data['instructions'] = $this->getServiceInstructions(2);
    }

    /**
     *  /list_receiving_countries
     * [ارجاع قائمة الدول لعملية طلب تحويل -سحب first .]
     * @group Wallet_transfer_withdraw
     * @return \Illuminate\Http\JsonResponse
     */
    public function listReceivingAgenciesCountries(Request $request){
        $countries = $this->getReceivingAgenciesCountries();
        //if not found
        if (!$countries) {
            return $this->fail_response(config('err_codes.data_not_found'),
                tt('no countries found'));
        }
        $countries = CountryResource::collection($countries);

        // if result found
        return $this->success_response($countries,tt('you_get_countries'));
    }

    /**
     *  /list_receiving_countries
     * [ارجاع قائمة الدول لعملية طلب تحويل -سحب first .]
     * @group Wallet_transfer_withdraw
     * @return \Illuminate\Http\JsonResponse
     */
    public function initTransferData(Request $request){
        $countries = $this->getReceivingAgenciesCountries();
        //if not found
        if (!$countries) {
            return $this->fail_response(config('err_codes.data_not_found'),
                tt('no countries found'));
        }
        $this->base_data['instructions'] = CountryResource::collection($countries);

        return $this->success_response($this->base_data,tt('you_get_countries'));
    }

    /**
     *  /choose_receive_type
     * [ارجاع الطريقة المرادة في عملية الاستلام -سحب second .]
     * @group Wallet_transfer_withdraw
     * @return \Illuminate\Http\JsonResponse
     */
    public function chooseReceivingTypes(Request $request){
        //do code to list
        $receive_types = [
            'cash','wallet',
        ];

        return $this->success_response($receive_types,tt('you_get_receive_types'));
    }

    /**
     *  /list_receiving_agencies_by_c_type/{country_id?}/{trans_type?}
     * [ارجاع وكالات الاستلام المتوفرة بناء على رقم الدولة ونوع طريقة الاستلام -سحب third .]
     * @bodyParam country_id  number    required  رقم الدولة
     * @bodyParam trans_type  number    required  نوع الطريقة [wallet/cash]
     * @group Wallet_transfer_withdraw
     * @return \Illuminate\Http\JsonResponse
     */
    public function listReceivingAgenciesByCountryIdReceivingType(
        Request $request,
        $country_id =247,
        $trans_type = 'wallet'
    ){
        $receivingAgencies = $this->getAgenciesByCountryReceiveType($country_id,$trans_type);
        if (!$receivingAgencies->count()) {
            return $this->fail_response(config('err_codes.data_not_found'),
                tt('no Agencies found'));
        }
        $receivingAgencies = ReceivingAgencyResource::collection($receivingAgencies);

        return $this->success_response($receivingAgencies,tt('you_get_Agencies_country'));
    }


    public function confirmTransferApiOrder(TransferOrderRequest $request){
        $validateInput = $this->validateTransferPostedData($request->all(),auth()->id());
        if ($validateInput['status'] == false) {
            return $this->fail_response(config('err_codes.invalid_posted_data'),$validateInput['msg']);
        }

        try {
            $created = $this->doTransferWithdrawOrder($validateInput['data'],auth()->id());
            //todo ZAHER complete do withdraw to wallet here make it in hold
            $countLoyaltyPoints =
                self::createLoyaltyPointsForService(config('ytadawul.all_services.copy_trading')
                    ,"TransferWithdrawOrder",$created->id,auth()->id());
        } catch (\Exception $ex) {
            return response()->json(["success" => false,"message" => $ex->getMessage()],200);
        }
        //todo Eman make this route and design view to withdraw orders
        // return redirect(route('list_transfer_orders'));

        return $this->success_response($created,'your_order_created_success');

    }

    /**
     * show a list of transferOrders
     *
     */

    public function listTransferOrders(Request $request){
        $orderStatus = ($request->filled('status'))? $request->status :null;

        $withdraw_orders = $this->getTransferOrders(auth()->id(),$orderStatus);
        $withdraw_orders = TransferWithdrawOrderResource::collection($withdraw_orders);

        return $this->success_response($withdraw_orders,'your_get_transfer_orders');
    }


}
