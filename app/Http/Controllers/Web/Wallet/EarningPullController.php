<?php

namespace App\Http\Controllers\Web\Wallet;

use App\Http\Controllers\BaseWebController;
use App\Http\Requests\DepositCustomerOrderRequest;
use App\Http\Resources\FreeLancingPlatformResource;
use App\Models\FreelancingPlatform;
use App\Notifications\PullEarningNotification;
use Illuminate\Http\Request;

class EarningPullController extends BaseWebController
{

    public const PULL_MENU = 'pull_earning';
    
    public function __construct() {
        parent::__construct($service_id = 5);
    }

//freelancing
    public function initFreelancingForm() {
        $free_lancing = FreelancingPlatform:: whereActive(1)->get();
        $instructions = $this->getServiceInstructions(5);

        return view('wallet.freelancing2')
            ->with('free_lancing_platforms', $free_lancing)
            ->with('active_menu', self::PULL_MENU)
            ->with('instructions', $instructions[0]->instructions);
    }

    /**
     *لعرض بوابات الدفع التي تتوفر في هذة المنصة المختارة
     */
    public function listPaymentsGateWayForPlatform($platform_id) {
        $gateways = $this->getPaymentsGateWayForPlatform($platform_id);
        if (!$gateways) {
            return \request()->wantsJson() ? response()->json([]) : [];
        }
        $gateways = FreeLancingPlatformResource::collection($gateways);

        return \request()->wantsJson() ? response()->json($gateways) : $gateways;
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

        $country_id = self::getUserCountryId();;
        $request["deposit_type"] = "cash";
        $createdOrder = $this->createPullEarningOrder($request->all(), auth()->id(), $country_id);
        //todo  may be the customer want to withdraw money to one of his finance accounts
        if ($request->deposit_turn_to == 'internal_withdraw') {
            // complete code to redirect it to internal withdraw
        }
        if (!$createdOrder || !$createdOrder->id) {
            return $request->wantsJson() ? response()->json([]) : [];
        }
        $createdOrder->customer->notify(new PullEarningNotification());
        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => "done", 'data' => $createdOrder, 'agency' => $createdOrder->agency->name]);
        }

//        return redirect(route('list_deposit_orders'));
        return response()->json(['success' => true, 'message' => "done"]);

    }

    public function listEarningPullOrders(Request $request) {
        $orderStatus = ($request->filled('status')) ? $request->status : null;

        $listDeposits = self::getDepositOrders(auth()->id(), $orderStatus, 'deposit', 1, "pull_earning");

        return view('wallet.history')
            ->with('type', "freelancing")
            ->with('data', $listDeposits);
    }

}
