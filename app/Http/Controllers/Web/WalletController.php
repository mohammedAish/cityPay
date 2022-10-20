<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\BaseWebController;
use App\Http\Controllers\Traits\CommonTrait;
use App\Http\Controllers\Traits\WalletTrait;
use App\Http\Requests\CustomerFinanceAccountRequest;
use App\Http\Requests\CustomerFinanceAccountRequest2;
use App\Http\Resources\DepositOrderResource;
use App\Models\Currency;
use App\Models\CustomerFinanceAccount;
use App\Models\DepositOrder;
use App\Models\PayingOrder;
use App\Models\TransferWithdrawOrder;
use App\Models\WalletTransfer;
use AshAllenDesign\LaravelExchangeRates\Classes\ExchangeRate;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;


class WalletController extends BaseWebController
{
    use WalletTrait, CommonTrait;

    public const FINANCE_ACCOUNTS_MENU = 'my_accounts';
    public const HOME_MENU = 'home';
    public const CURRENCIES_MENU = 'currency_exchange';

    public function dashboard() {

        $completedTransactions = self::lastOrders(auth()->id(),
            'accepted', null, 5, 'created_at', 'desc');
        $recentPendingOrders   = self::lastOrders(auth()->id(),
            "pending", null, 30, 'created_at', 'desc');
        if (request()->wantsJson()) {
            $completedTransactions = DepositOrderResource::collection($completedTransactions);
            $recentPendingOrders   = DepositOrderResource::collection($recentPendingOrders);
        }
        $data['completed']  = $completedTransactions;
        $data['pending']    = $recentPendingOrders;
        $lastDeposit        = self::lastOrders(auth()->id(),"confirmed", 'deposit', 1, 'created_at', 'desc');
        $lastWithdraw       = self::lastOrders(auth()->id(),"confirmed", 'withdraw', 1, 'created_at', 'desc');
        $last_transfer      = self::getTransferOrders(auth()->id())->first();
        $dashboard_overview = self::getServiceInstructions(7);//for dashboard is 7
        
        $latest_orders = DepositOrder::query()
            ->where('customer_id', auth()->id())
            ->where('created_at', '>', Carbon::now()->subDays(7))
            ->orderByDesc('created_at')
            ->limit(5)
//            ->where('op_type', 'deposit')
            ->get();

        $last_trans = WalletTransfer::where('customer_id', auth()->id())
            ->orderByDesc('created_at')
//            ->selectRaw("'transfer' AS op_type, 'completed' as current_status, final_amount as amount, created_at")
            ->first();
//        $latest_withdraw_orders = DepositOrder::query()
//            ->where('customer_id', auth()->id())
//            ->where('created_at', '>', Carbon::now()->subDays(7))
//            ->where('op_type', 'deposit')
//            ->get();

        return \request()->wantsJson()
            ? response()->json(['completed' => $completedTransactions, 'pending' => $recentPendingOrders])
            : view('wallet.dashboard')
                ->with('completed', $completedTransactions)
                ->with('last_deposit', $lastDeposit)
                ->with('last_withdraw', $lastWithdraw)
                ->with('last_trans', $last_trans)
                ->with('last_transfer', $last_transfer)
                ->with('pending', $recentPendingOrders)
                ->with('overview', $dashboard_overview)
                ->with('latest_orders', $latest_orders)
                ->with('active_menu', self::HOME_MENU)
                ->with('data', $data);
    }

    public function listFreelancingOrders(Request $request) {
        return view('wallet.orders.freelancing');
    }

    public function listPurchaseOrders(Request $request) {
        return view('wallet.orders.purchase');
    }

    public function listFinanceAccounts(Request $request) {
        $listAcccounts = $this->getCustomerFinanceAccounts2(auth()->id());

//        $listAcccounts = FinanceAccountResource::collection($listAcccounts);

        return view('wallet.myaccounts2')->with('finance_accounts', $listAcccounts)->with('active_menu', self::FINANCE_ACCOUNTS_MENU);
    }

    public function currencies() {
        $exchangeRates = new ExchangeRate();
        
        $currencies = self::getCurrencies();

        foreach ($currencies as $currency){
            try {
                $currency->exchange_price = $exchangeRates->exchangeRate('USD', $currency->code);
            }catch (\Exception $exception){
                $currency->exchange_price = $currency->exchange_price;
            }
        }
        
        return view('wallet.currency2')->with('is_post', false)->with('currencies', $currencies)->with('active_menu', self::CURRENCIES_MENU);
    }
    
    public function convertCurrency(Request $request)
    {
        $currencies = self::getCurrencies();
        
        $exchangeRates = new ExchangeRate();
        $exchange_form = $request->get('exchange_form', 'EUR');
        $exchange_to = $request->get('exchange_to', 'USD');
        $amount = $request->get('amount', 1);
        $to_curr = Currency::query()->where('code', $exchange_to)->first();
        try {
            $exchange_rate = $exchangeRates->exchangeRate($exchange_form, $exchange_to);
        }catch (\Exception $exception){
            $exchange_rate = 1;
        }
        $exchange_price = $amount * $exchange_rate;
        

        return view('wallet.currency2')
            ->with('is_post', true)
            ->with('to_curr', $to_curr)
            ->with('exchange_form', $exchange_form)
            ->with('exchange_to', $exchange_to)
            ->with('amount', $amount)
            ->with('exchange_price', $exchange_price)
            ->with('currencies', $currencies)
            ->with('active_menu', self::CURRENCIES_MENU);
    }

    public function showAddingFinanceAccount() {
        $instructions = self::getServiceInstructions(2);
        /* $agenciesCountry =
             $this->getAgenciesForFinanceAccountByCountry(auth()->user()->country_code);*/
        $depositTypes = self::getDepositTypes();

        return view('wallet.add_my_account2')
            //->with('agencies', $agenciesCountry)
            ->with('deposit_types', $depositTypes)
            ->with('instructions', $instructions)
            ->with('active_menu', self::FINANCE_ACCOUNTS_MENU);
    }

    public function getWithdrawAgencyByMethod(Request $request, $method_id) {
        $country_id       = self::getUserCountryId();//YEMEN 247
        $deposit_agencies = self::getDepositAgencyByMethod($method_id, $country_id, 1);
//        if ((!$deposit_agencies->count()) > 0) {
//            return $request->wantsJson() ? response()->json([]) : [];
//        }
//        //todo OSAMA complete the return to you
//        //but the best to return to json so if no agency how to know
//        return view('wallet.agency_select', [
//            "agencies" => $deposit_agencies,
//            "name"     => "agency_id",
//            "label"    => " الوكالة ...",
//        ])->render();
        return view('wallet.agency_select2', [
            "agencies" => $deposit_agencies,
            "name"     => "deposit_agency_id",
            "label"    => cp('agency'),
        ])->render();
    }


    public function storeFinanceAccount(CustomerFinanceAccountRequest2 $request) {
        $createdFinance = $this->createCustomerFinanceAccount(auth()->id(), $request->validated());
        return ["status" => "success", "data" => $createdFinance, "message" => "تم التعديل بنجاح"];
    }
    
    public function editFinanceAccount($id, Request $request)
    {
        $my_account = CustomerFinanceAccount::query()->where('customer_id', auth()->id())->where('id', $id)->firstOrFail();

        $instructions = self::getServiceInstructions(2);
        /* $agenciesCountry =
             $this->getAgenciesForFinanceAccountByCountry(auth()->user()->country_code);*/
        $depositTypes = self::getDepositTypes();

        return view('wallet.edit_my_account')
            //->with('agencies', $agenciesCountry)
            ->with('deposit_types', $depositTypes)
            ->with('instructions', $instructions)
            ->with('finance_account', $my_account)
            ->with('active_menu', self::FINANCE_ACCOUNTS_MENU);
    }

    public function getCustomerBalance() {
        return response()->json(['balance' => auth()->user()->balanceFloat]);
    }

    public function saveOrderImage(Request $request) {

        $d_order = DepositOrder::find($request->order_id);
        if ($d_order->current_status == 'confirmed') {
            return ["status"  => "fail", "data" => '',
                    "message" => "لا يمكن تعديل الصورة بعد اكتمال حالة الطلب"];
        }

        $path    = self::createImageFromFile($request, 'fileup', 'deposits');
        $updated = DepositOrder::where('id', $request->order_id)->update(["img_path" => $path]);

        return ["status" => "success", "data" => asset($path), "message" => "تم التعديل بنجاح"];
    }


    public function getOperationInfo(Request $request) {

        if ($request->type == "transfer") {
            $data = TransferWithdrawOrder:: with([
                'agencyCountry.country:id,name', 'agencyCountry.transferAgency:id,agency_name'
                , 'currency:id,name',
            ])->where("id", $request->id)->get()->first();
        } elseif ($request->type == "invoices") {
            $data = PayingOrder::findOrFail($request->id);
        } else {
            $data = DepositOrder::with([
                'agencyCountry.country:id,name', 'agency:id,name'
                , 'currency:id,name', 'currencyClient:id,name',
            ])->where("id", $request->id)->get()->first();
        }

        return view("wallet.history_tabs.model_info")
            ->with("type", $request->type)
            ->with("data", $data)
            ->with("data_type", $request->data_type)
            ->render();
    }
    
    public function getNotifications()
    {
        return view('wallet.notifications')
            ->with('notifications', auth()->user()->unreadNotifications);
    }

    
    public function markNotificationAsRead($id)
    {
        try {
            $notification = DatabaseNotification::where('id', $id)->first();
            $notification->markAsRead();
            return redirect($notification->data['action']);
        }catch (\Exception $exception){
            
        }
    }

}
