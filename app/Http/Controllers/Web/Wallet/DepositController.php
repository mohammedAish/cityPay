<?php

namespace App\Http\Controllers\Web\Wallet;


use App\Http\Controllers\BaseWebController;
use App\Http\Controllers\Traits\CommonTrait;
use App\Http\Controllers\Traits\WalletTrait;
use App\Http\Requests\DepositCustomerOrderRequest;
use App\Http\Resources\DepositMethodResource;
use App\Models\DepositOrder;
use App\Models\PayingOrder;
use App\Models\TransferWithdrawOrder;
use App\Models\WalletTransfer;
use App\Notifications\OrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DepositController extends BaseWebController
{

    use WalletTrait, CommonTrait;

    public const DEPOSIT_WITHDRAW = 'deposit_withdraws';
    
    public function __construct() {
        //to show instruction for deposit we pass number 1  ,1 is stored in db for instruction id for deposit
        parent::__construct($service_id = null);

    }

    /**
     * first step in new deposit model
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function initDepositOrderData() {

        // $country_id      = self::getUserCountryId();
        //  $agenciesCountry = self::getDepositAgenciesByCountry($country_id);
        $depositTypes      = self::getDepositTypes();
        $order_instruction = self::getServiceInstructions(1);                               //deprecated
        $currencies        = self::getCurrencies();

        $latest_order = DepositOrder::query()->where('customer_id', auth()->id())->latest()->first();
        $process_number = 1;
        if ($latest_order){
            $process_number = $latest_order->id + 1;
        }
        return view('wallet.deposit')
            ->with('currencies', $currencies)
            ->with('instructions', $order_instruction)
            ->with('active_menu', 'deposit')
            ->with('process_number', $process_number)
            ->with('deposit_types', $depositTypes)//  ->with('agencies', $agenciesCountry) //we dont need it now
            ;
    }

    /**
     * @deprecated
     * first step
     * to show the countries that active and YTadawul has accounts in it
     */
    /*public function listCountriesOfDepositAgencies(Request $request){
        $countries = $this->getCountriesOfDepositAgencies();
        //if not found

        if (!$countries) {
            return $request->wantsJson()? response()->json([]) :false;
        }
        // if result found
        $countries = CountryResource::collection($countries);
        if ($request->wantsJson()) {
            return response()->json($countries);
        }

        return $countries;
    }*/

    /**
     * @return \Illuminate\Support\Collection
     * @deprecated
     * لارجاع الوكلات للشخص في الدولة التي يتبعها لعمل الايداع والسحب الداخلي
     * list All Agencies tha active by
     */
    public function listAgenciesByCountryId(Request $request, $country_id = null) {
        $country_id      = $country_id ?? $this->getUserCountryId();//YEMEN 247
        $agenciesCountry = $this->getDepositAgenciesByCountry($country_id);
        //if not found
        if (!$agenciesCountry) {
            return null;
        }

        return $agenciesCountry;
    }

    /**
     * لارجاع الطرق التي تتعامل بها الوكالة في حالة الايداع
     * list depositTypesByAgencyCountryId
     * @deprecated  in the old model
     */
    public function getDepositTypeByAgencyCountry(Request $request, $agency_id) {
        $deposit_types = self::getDepositTypesFromAgency($agency_id);
        if (!$deposit_types) {
            return $request->wantsJson() ? response()->json([]) : [];
        }
        $deposit_types = DepositMethodResource::collection($deposit_types);

        return $request->wantsJson() ? response()->json($deposit_types) : $deposit_types;
    }

    /**
     * لارجاع الوكالات المحلية  التي تتوافق بالطريقة المختارة
     * في نطاق هذة الدولة التي ينتمي لها المستخدم او الوكالات العالمية
     * list DepositAgencyByDepositMethod
     */

    public function getDepositAgencyByDepositMethod(Request $request, $method_id) {

        $country_id = self::getUserCountryId(); //todo ZAHER complete to get country from IP fornow

        $deposit_agencies = self::getDepositAgencyByMethod($method_id, $country_id, 0);
//        if ((!$deposit_agencies->count()) > 0) {
//            return $request->wantsJson() ? response()->json([]) : [];
//        }

//        $data = [];
//        foreach ($deposit_agencies as $deposit_agency){
//            $data[] = [ 
//                'id' => $deposit_agency->id,
//                'text' => $deposit_agency->name,
//            ];
//        }
//        return response()->json([
//            'success' => true,
//            'data' => $data,
//        ]);
        return view('wallet.agency_select2', [
            "agencies" => $deposit_agencies,
            "name"     => "deposit_agency_id",
            "label"    => cp('agency'),
        ])->render();
    }

    public function showTestDeposit() {
        return view('test_folder.test_deposit');
    }

    /**
     * will confirm the deposit order as once
     *
     * @param  country_id
     * @param  agency_id
     * @param  deposit_type_id
     * @param  reference_id  optional refer to account_number of customer or customer email
     * @param  deposit_file
     *
     * @decription_info
     * @return \Illuminate\Http\JsonResponse|array
     * @throws \Exception
     */
    public function confirmDepositOrder(DepositCustomerOrderRequest $request) {
        $country_code = self::getUserCountryId();
        $createdOrder = self::createDepositOrder($request->all(), auth()->id(), $country_code);
        if (!$createdOrder || !$createdOrder->id) {
            return $request->wantsJson() ? response()->json([]) : [];
        }
        $createdOrder->customer->notify(new OrderNotification($createdOrder));
        $hasRedirectUrl = false;
        $redirectUrl = '';
        if ($createdOrder->agency_id == 5 && $createdOrder->agency->is_automatic){
            $hasRedirectUrl = true;
            $redirectUrl = $this->payWithPayeer($createdOrder);
        }

        $submitperfectMoneyForm = false;
        if ($createdOrder->agency_id == 15 && $createdOrder->agency->is_automatic){
            $submitperfectMoneyForm = true;
//            $hasRedirectUrl = true;
//            $redirectUrl = $this->payWithPerfectMoney($createdOrder);
        }
        
        session()->flash('order_msg', cp('confirm_order_success_message'));
        
        return response()->json([
            'status' => true,
            'message' => cp('confirm_order_success_message'),
            'data' => $createdOrder,
            'has_redirect_url' => $hasRedirectUrl,
            'redirect_url' => $redirectUrl,
            'submit_perfect_money_form' => $submitperfectMoneyForm,
        ]);
    }


    //show all deposits and internal_withdraws
    public function listAllDepositOrders(Request $request) {
        $orderStatus       = ($request->filled('status')) ? $request->status : null;
//        $listDeposits      = self::getDepositOrders(auth()->id(), "confirmed", null, 1);
//        $deposits          = $listDeposits->map(function ($item) {
//            return $item->op_type === 'deposit';
//        });
//        $internal_withdraw = $listDeposits->map(function ($item) {
//            return $item->op_type === 'withdraw';
//        });

        $orders = DepositOrder::query()
            ->where('customer_id', auth()->id())
            ->orderByDesc('created_at')
            ->get();
        
        $deposit_orders = $orders->filter(function ($item) {
            return $item->order_type === 'normal_deposit';
        });

        $withdraw_orders = DepositOrder::query()
            ->where('deposit_orders.customer_id', auth()->id())
            ->join('customer_finance_accounts', 'deposit_orders.agency_id', '=', 'customer_finance_accounts.agency_id')
            ->orderByDesc('deposit_orders.created_at')
            ->where('order_type', 'normal_withdraw')
            ->selectRaw('deposit_orders.*, customer_finance_accounts.wallet_number, customer_finance_accounts.customer_agency_acc_number, customer_finance_accounts.deposit_type AS user_deposit_type, customer_finance_accounts.soft_bank, customer_finance_accounts.address as customer_address, customer_finance_accounts.recipient_name, customer_finance_accounts.phone_number')
            ->get();
//        $withdraw_orders = $orders->filter(function ($item) {
//            return $item->order_type === 'normal_withdraw';
//        });
        
        $freelancing_orders = $orders->filter(function ($item) {
            return $item->order_type === 'pull_earning';
        });

        $pay_bills_orders = PayingOrder::where('customer_id', auth()->id())
            ->orderByDesc('created_at')
            ->get();

//        $TransferWithdrawOrder = TransferWithdrawOrder::where('customer_id', auth()->id())
//            ->orderByDesc('created_at')
//            ->get();

        $TransferWithdrawOrder = WalletTransfer::where('customer_id', auth()->id())
            ->orderByDesc('created_at')
            ->get();
        
        
        return view('wallet.processes.index')
            ->with('type', "transactions")
            ->with('deposit_orders', $deposit_orders)
            ->with('withdraw_orders', $withdraw_orders)
            ->with('freelancing_orders', $freelancing_orders)
            ->with('pay_bills_orders', $pay_bills_orders)
            ->with('transfer_withdraw_order', $TransferWithdrawOrder)
            ->with('orders', $orders)
            ->with('active_menu', self::DEPOSIT_WITHDRAW);
//            ->with('data', $listDeposits);
    }


    public function listDepositOrders(Request $request) {
        session()->keep('order_msg');
        $orderStatus  = ($request->filled('status')) ? $request->status : null;
        $listDeposits = self::getDepositOrders(auth()->id(), $orderStatus, 'deposit', 1, "normal_deposit");
        return view('wallet.history')
            ->with('type', "deposit")
            ->with('data', $listDeposits);
    }

    public function exportPdfImage(Request $request)
    {
//        $data = ;
//        foreach ($data as $key => $value) {
//            return $key;
//        }

        $allowed_data = [
            'success_operation_process_number', 'success_operation_deposit_system', 'success_operation_amount_in_dollars', 
            'success_operation_deposit_commission', 'success_operation_amount_to_paid', 'success_operation_amount', 'success_operation_our-fees',
            'success_operation_total_withdraw_with_fee', 'success_operation_withdraw-system', 'success_operation_account-number',
            'success_operation_account-name'
        ];
        
        $pdf = \PDF::loadView('wallet.export_pdf', [
            'data' => $request->all(),
            'allowed_data' => $allowed_data,
            ]);
        return $pdf->download('data_'. time() .'.pdf');
    }

}
