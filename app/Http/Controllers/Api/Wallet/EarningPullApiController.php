<?php

namespace App\Http\Controllers\Api\Wallet;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Controllers\Traits\WalletTrait;
use App\Http\Requests\DepositCustomerOrderRequest;
use App\Http\Resources\DepositOrderResource;
use App\Http\Resources\FreeLancingPlatformResource;
use App\Models\FreelancingPlatform;
use Illuminate\Http\Request;

class EarningPullApiController extends BaseApiController
{
    use WalletTrait;

    public function __construct(Request $request) {
        parent::__construct($request);
        $this->base_data['instructions'] = $this->getServiceInstructions(1);
    }

    public function initFreelancingData() {
        $this->base_data['freelancing_platforms'] = FreelancingPlatform::whereActive(1)->get();

        return $this->success_response($this->base_data, 'you_get_freelancing_platforms');
    }

    /**
     *لعرض بوابات الدفع التي تتوفر في هذة المنصة المختارة
     */
    public function listPaymentsGateWayForPlatform($platform_id) {
        $gateways = $this->getPaymentsGateWayForPlatform($platform_id);
        if (!$gateways) {
            return $this->fail_response(config('err_codes.data_not_found'), 'no payments for this platform');
        }
        $gateways = FreeLancingPlatformResource::collection($gateways);

        return $this->success_response($gateways, 'you_get_gateways');
    }

    /**
     * will confirm the pulling order as once
     *
     * @param  platform_id
     * @param  amount
     * @param  deposit_agency_id
     * @param  currency_id
     * @param  deposit_turn_to //where the customer want to move this money[wallet/internal_withdraw]
     * @param  reference_id  optional refer to account_number of customer or customer email
     * @param  attached_file optional
     *
     * @decription_info
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function confirmPullEarningOrder(DepositCustomerOrderRequest $request) {
        $country_id   = $this->getUserCountryId();
        $createdOrder = $this->createPullEarningOrder($request->all(), auth()->id(), $country_id);

        if (!$createdOrder || !$createdOrder->id) {
            return $this->fail_response(config('err_codes.data_not_found'), "no data updated");
        }


        return $this->success_response($createdOrder, 'you_create_order_success');
    }

    public function listPullEarningOrders(Request $request) {
        $orderStatus           = ($request->filled('status')) ? $request->status : null;
        $listInternalWithdraws = $this->getPullEarningOrders(auth()->id(), $orderStatus);
        $listInternalWithdraws = DepositOrderResource::collection($listInternalWithdraws);

        return $this->success_response($listInternalWithdraws, 'you_get_all_pull_earning_orders');
    }
}
