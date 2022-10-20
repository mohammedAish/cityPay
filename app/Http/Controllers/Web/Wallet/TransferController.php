<?php

namespace App\Http\Controllers\Web\Wallet;

use App\Http\Controllers\BaseWebController;
use App\Http\Controllers\Traits\WalletTrait;
use App\Http\Requests\TransferOrderRequest;
use App\Http\Resources\CountryResource;
use App\Http\Resources\ReceivingAgencyCountryResource;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Customer;
use App\Models\TransferSetting;
use App\Models\WalletTransfer;
use AshAllenDesign\LaravelExchangeRates\Classes\ExchangeRate;
use Illuminate\Http\Request;

class TransferController extends BaseWebController
{
    use WalletTrait;

    /**
     * first
     * to show the ReceivingAgencies Countries that active and YTadawul has accounts in it
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function index() {
        $countries    = $this->getReceivingAgenciesCountries();
        $instructions = $this->getServiceInstructions(4);

        return view("wallet.transfer")
            ->with("countries", $countries)
            ->with('instructions', $instructions);
    }

    public function listReceivingAgenciesCountries(Request $request) {
//        $countries = $this->getReceivingAgenciesCountries();
        $countries = Country::where('active', 1)->get();
        //if not found
        if (!$countries) {
            return $request->wantsJson() ? response()->json([]) : false;
        }
        $countries = CountryResource::collection($countries);
        // if result found
        if ($request->wantsJson()) {
            return response()->json($countries);
        }
        $instructions = $this->getServiceInstructions(4);

        $transfer_setting = TransferSetting::query()->pluck('value', 'name')->toArray();
        $currencies        = self::getCurrencies();
        return view('wallet.transfer2')
            ->with('countries', $countries)
            ->with('currencies', $currencies)
            ->with('active_menu', 'transfer_order')
            ->with('transfer_setting', $transfer_setting)
            ->with('instructions', $instructions);
    }

    public function getExchange(Request $request)
    {
        try {
            $currency_code = $request->get('currency_code');
            $curr = Currency::query()->where('code', $currency_code)->first()->exchange_price;

            if ($request->get('is_fixed') == 1){
                return response()->json(['value' => $curr * $request->get('amount') . ' USD']);
            }else{
                $exchangeRates = new ExchangeRate();
                $exchange_price = $exchangeRates->exchangeRate('USD', $currency_code);
                return response()->json(['value' => $exchange_price * $request->get('amount') . ' USD']);
            }
        }catch (\Exception $exception){
            return response()->json(['value' => 'USD']);
        }
    }
    /**
     * second
     * choose the receiving type that customer choose it
     */
    public function chooseReceivingTypes(Request $request) {
        //do code to list
        if ($request->wantsJson()) {
            return response()->json(['cash', 'wallet']);
        }

        return [
            'cash', 'wallet',
        ];
    }


    /**
     * list All ReceivingAgencies tha active by country id
     *
     * @param $request
     * @param $country_id
     * @param $trans_type
     */
    public function listReceivingAgenciesByCountryIdReceivingType(

        $country_id = 247,
        $trans_type = 'wallet'
    ) {
        $receivingAgencies = $this->getAgenciesByCountryReceiveType($country_id, $trans_type);
        //if not found
        if (!$receivingAgencies->count() > 0) {
            return \request()->wantsJson() ? response()->json(array()) : [];
        }
        $receivingAgencies = ReceivingAgencyCountryResource::collection($receivingAgencies);


        return \request()->wantsJson() ? response()->json($receivingAgencies) : $receivingAgencies;
    }


    public function confirmTransferOrder(TransferOrderRequest $request) {
        $validateInput = $this->validateTransferPostedData($request->all(), auth()->id());
        if ($validateInput['status'] == false) {
            return $request->wantsJson() ? response()->json(["success" => false, "message" => $validateInput['msg']],
                200) : $validateInput['msg'];
        }

        try {
            $created            = $this->doTransferWithdrawOrder($validateInput['data'], $request->all(), auth()->id());
            $countLoyaltyPoints =
                self::createLoyaltyPointsForService(config('ytadawul.all_services.payment_from_net')
                    , "TransferWithdrawOrder", $created->id, auth()->id());
        } catch (\Exception $ex) {
            return response()->json(["success" => false, "message" => $ex->getMessage()], 200);
        }
        //todo Eman make this route and design view to withdraw orders
        //    return redirect(route('list_transfer_orders'));

        return response()->json(["success" => true, "data" => $created, "message" => "تم تقديم الطلب بنجاح"], 200);
    }


    /**
     * show a list of transferOrders
     *
     */

    public function listTransferOrders(Request $request) {
        $orderStatus     = ($request->filled('status')) ? $request->status : null;
        $Withdraw_orders = $this->getTransferOrders(auth()->id(), $orderStatus, 1);

        //todo Eman complete where you want to show the list
        return view('wallet.history')
            ->with('type', "transfer")
            ->with('data', $Withdraw_orders);
    }


    /**
     * for test only
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function transferTest() {
        //  auth()->user()->depositFloat(1000);
        return view('test_folder.test_transfer')->with('countries', Country::all()->pluck('name', 'id'));
    }
    
    public function transfer_to_wallet(Request $request)
    {
        try {
            if (empty($request->get('wallet_number')) || empty($request->get('wallet_trans_amount'))){
                throw new \Exception('يجب إدخال رقم المحفظة والمبلغ');
            }
            
            $amount = $request->get('total_amount', 0);

            if (auth()->user()->balanceFloat < $amount){
                throw new \Exception('المبلغ اكبر من رصيدك');
            }
            $withdraw_trx = Customer::find(auth()->id())
                ->withdrawFloat($amount, [], true);
            
            $fee = 0;
            $transfer_setting = TransferSetting::query()->pluck('value', 'name')->toArray();
            if(!empty(auth()->user()->document()) && auth()->user()->document()->status == 1){
                $fee = (double)$transfer_setting['verified_account_fee'];
            }else{
                $fee = (double)$transfer_setting['unverified_account_fee'];
            }
            WalletTransfer::query()->create([
                'wallet_number' => $request->get('wallet_number'),
                'amount' => $request->get('wallet_trans_amount'),
                'fee' => $fee,
                'final_amount' => $request->get('total_amount'),
                'currency' => 1,
                'status' => 1,
                'customer_id' => auth()->id(),
            ]);

            $response = [
                'success' => true,
                'message' => 'تم التحويل بنجاح',
            ];
        }catch (\Exception $exception){
            $response = [
                'success' => false,
                'message' => $exception->getMessage(),
            ];
        }

        return response()->json($response);
    }
}
