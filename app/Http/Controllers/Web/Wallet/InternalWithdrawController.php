<?php

namespace App\Http\Controllers\Web\Wallet;

use App\Http\Controllers\BaseWebController;
use App\Http\Controllers\Traits\WalletTrait;
use App\Http\Requests\InternalWithdrawRequest;
use App\Models\DepositAgency;
use App\Notifications\OrderNotification;
use Illuminate\Http\Request;

class InternalWithdrawController extends BaseWebController
{
    use WalletTrait;

    //   for the internal withdraw that will be for person himself

    /**
     * لعرض الحسابات المالية للعميل لاختيار احدها في طلب السحب
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Support\Collection
     */
    public function listFinanceAccounts() {
        $accounts = $this->getCustomerFinanceAccounts(auth()->id());

        return \request()->wantsJson() ? response()->json($accounts) : $accounts;
    }

    public function showWithdrawForm() {
        $accounts = $this->getCustomerFinanceAccounts3(auth()->id());

        return view('wallet.withdraw')->with('accounts', $accounts)->with('active_menu', 'withdraw');
    }

    public function getWithdrawPercent($amount = 0, $agency_id = 0) {
        $info    = DepositAgency::find($agency_id);
        $percent = $info->withdraw_fee_percent;
        $percent = number_format(($amount * $percent / 100) + $info->fixed_charge_withdraw, 2);

        return response()->json($percent);
    }

    public function showTestInternalWithdraw() {
        return view('test_folder.test_internal_withdraw');
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
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function confirmInternalWithdraw(InternalWithdrawRequest $request) {
        //$country    = getCountryFromIP();
        $country_id = $this->getUserCountryId();

        if (!self::checkUserBalanceForInternalWithdraw($request->all(), auth()->user())) {
            throw new \Exception(cp('no_balance_for_withdraw'));
        }

        $createdOrder = self::createInternalWithdrawOrder($request->all(), auth()->id(), $country_id);

        auth()->user() ? auth()->user()->notify(new OrderNotification($createdOrder, cp('withdraw_notification_subject'), cp('withdraw_notification_description'))) : null;

        if (!$createdOrder || !$createdOrder->id) {
            return response()->json([]);
        }

        if ($request->wantsJson()) {
            return response()->json(['status' => true, 'data' => $createdOrder]);
        }

        return redirect(route('list_internal_withdraw_orders'));
    }

    public function listInternalWithdrawOrders(Request $request) {
        $orderStatus           = ($request->filled('status')) ? $request->status : null;
        $listInternalWithdraws = $this->getWithdrawOrders(auth()->id(), $orderStatus, 1);

        return view('wallet.history')
            ->with('type', "withdraw")
            ->with('data', $listInternalWithdraws);
    }

}
