<?php


namespace App\Http\Controllers\Traits;


use App\Models\Country;
use App\Models\Currency;
use App\Models\Customer;
use App\Models\CustomerFinanceAccount;
use App\Models\DepositAgency;
use App\Models\DepositAgencyCountry;
use App\Models\DepositMethod;
use App\Models\DepositOrder;
use App\Models\PayingOrder;
use App\Models\ReceivingAgenciesCountry;
use App\Models\TransferAgency;
use App\Models\TransferWithdrawOrder;
use DB;
use Exception;
use Illuminate\Support\Facades\Config;
use Throwable;

trait WalletTrait
{
    use OrderTrait;

    /*static function getCountriesOfDepositAgencies() {
        $countriesList = DepositAgencyCountry::
        select(DB::raw('distinct(country_id)'))
            ->get()->pluck('country_id');
        $countries     = Country::whereIn('id', $countriesList)
            ->where('active', 1)->get();

        return $countries ?? [];
    }*/

    public static function getDepositAgenciesByCountry($country_id)
    {
        return DepositAgency::
        join('deposit_agency_countries',
            'deposit_agencies.id', '=',
            'deposit_agency_countries.deposit_agency_id')
            ->where(function ($q) use ($country_id) {
                return $q->where('deposit_agency_countries.country_id', $country_id)
                    ->orWhere('deposit_agencies.national', 'international');
            })->whereNotNull('deposit_agency_countries.ytadawul_account_number')
            ->where('active', 1)
            ->select(['deposit_agencies.*', 'deposit_agency_countries.id as d_c_id',

                'deposit_agency_countries.ytadawul_account_number'])
            ->get();
    }

    public static function getDepositTypes()
    {
        return DepositMethod::whereActive(1)->get();
    }


    public function isFoundedFinanceAccount($customer_id, $agency_id)
    {
        $found = CustomerFinanceAccount::where('customer_id', $customer_id)
            ->where('agency_id', $agency_id)->first();

        return $found ?? false;
    }

    public function creatCustomerFinanceAccount($customer_id, $posted_data)
    {
        $data_unique['customer_id'] = $customer_id;
        $data_unique['agency_id'] = $posted_data['agency_id'];
        $data['customer_agency_acc_number'] = $posted_data['customer_agency_acc_number'];
        $data['customer_agency_acc_name'] = $posted_data['customer_agency_acc_name'];

        return CustomerFinanceAccount::updateOrCreate($data_unique, $data);
    }

    public function createCustomerFinanceAccount($customer_id, $posted_data)
    {
        $deposit_type = $posted_data['deposit_type'];
        $data_unique['customer_id'] = $customer_id;
        $data_unique['agency_id'] = $posted_data['agency_id'];
        $data = [];
        $data['deposit_type'] = $deposit_type;
        if ($deposit_type == 1) {
            $data['recipient_name'] = $posted_data['recipient_name_transfer'];
            $data['phone_number'] = $posted_data['phone_number_transfer'];
            $data['address'] = $posted_data['address_transfer'];
        } else if ($deposit_type == 2) {
            $data['wallet_number'] = $posted_data['wallet_number_banking'];
        } else if ($deposit_type == 4) {
            $data['wallet_number'] = $posted_data['wallet_number_crypto'];
        } else if ($deposit_type == 12) {
            $data['customer_agency_acc_name'] = $posted_data['customer_agency_acc_name'];
            $data['customer_agency_acc_number'] = $posted_data['customer_agency_acc_number'];
            $data['address'] = $posted_data['address_international'];
            $data['soft_bank'] = $posted_data['soft_bank_international'];
        }
        return CustomerFinanceAccount::updateOrCreate($data_unique, $data);
    }

    static function getDepositTypesFromAgency($agency_id)
    {
        return DepositAgency::find($agency_id)->depositMethod->name;
//        $depositMethods = DepositAgency::
//    /*    join('deposit_agencies_methods', "deposit_agencies.id",
//            "=", "deposit_agencies_methods.deposit_agency_id")*/
//            join('deposit_methods', "deposit_agencies.deposit_method_id",
//                "=", "deposit_methods.id")
//            ->where('deposit_agencies.id', $agency_id)
//            ->select('deposit_methods.*')
//            ->get();

        //   return $depositMethods;
    }

    public function getAgenciesForFinanceAccountByCountry($country_id)
    {
        return DepositAgency::
        join('deposit_methods',
            'deposit_agencies.deposit_method_id', '=',
            'deposit_methods.id')
            ->where(function ($q) use ($country_id) {
                return $q->where('country_id', $country_id)
                    ->orWhere('national', 'international');
            })->where('active', 1)
            ->where('is_withdraw_agency', 1)
            ->select(['deposit_agencies.*', 'deposit_agency_countries.id as d_c_id',
                'deposit_agency_countries.ytadawul_account_number'])->get();
    }

    public static function getDepositAgencyByMethod($method_id, $country_id, $for_withdrawal = 0)
    {
        return DepositAgency::
        join('deposit_methods',
            "deposit_agencies.deposit_method_id", "=",
            "deposit_methods.id")
            /*   ->join('deposit_methods',
                   "deposit_agencies_methods.deposit_method_id", "=",
                   "deposit_methods.id")*/
            ->join('deposit_agency_countries',
                'deposit_agencies.id', '=',
                'deposit_agency_countries.deposit_agency_id')
            ->where('deposit_methods.id', $method_id)
            //any agency is deposit but some for deposit and withdrawal
            ->when($for_withdrawal == 1, function ($q) {
                return $q->where('is_withdraw_agency', 1);
            })->where(function ($q) use ($country_id) {
                return $q->where('deposit_agencies.national', 'international')
                    ->orWhere('deposit_agency_countries.country_id', $country_id);
            })->select([
                'deposit_agencies.*',
                'deposit_agency_countries.fee_percent',
                //'deposit_agency_countries.ytadawul_account_number',
                //   'deposit_agency_countries.ytadawul_account_name',
                'deposit_methods.id as d_m_id'
            ])->get();
    }


    public static function getWithdrawOrders($customer_id, $status = null, $pageing = 0)
    {
        return self::getDepositOrders($customer_id, $status, 'withdraw', $pageing);
    }


    public static function getPullEarningOrders($customer_id, $status = null)
    {
        return self::getDepositOrders($customer_id, $status, 'pull_earning');
    }


    public static function getDepositOrders($customer_id, $status = null, $op_type = null, $pageing = 0, $order_type = null)
    {
        //order_type maybe 'normal_deposit','normal_withdraw','pull_earning','paying_order'
        $list = DepositOrder::
        with([
            'agencyCountry.country:id,name', 'agency:id,name'
            , 'currency:id,name',
        ])->where('customer_id', $customer_id)
            ->when($op_type, function ($q) use ($op_type) {
                return $q->where('op_type', $op_type);
            })
            ->when($order_type != null, function ($q) use ($order_type) {
                return $q->where('order_type', $order_type);
            })
            ->when($status != null, function ($query) use ($status) {
                if (is_array($status)) {
                    return $query->whereIn('current_status', $status);
                }

                return $query->where('current_status', $status);
            })->orderByDesc("created_at");
        if ($pageing == 1) {
            return $list->paginate(\config('ytadawul.per_page', 10));
        }

        return $list->get();
    }

    public static function lastOrders(
        $customer_id,
        $status = null,
        $op_type = null,
        $limit = 30,
        $sort_col = null,
        $sort_type = 'asc'
    )
    {
        return DepositOrder::
        with([
            'agencyCountry.country:id,name', 'agencyCountry.depositAgency:id,name'
            , 'currency:id,name',
        ])
            ->where('customer_id', $customer_id)
            ->when($op_type, function ($q) use ($op_type) {
                return $q->where('op_type', $op_type);
            })->when($status != null, function ($query) use ($status) {
                if (is_array($status)) {
                    return $query->whereIn('current_status', $status);
                }

                return $query->where('current_status', $status);
            })->when($sort_col != null, function ($query) use ($sort_col, $sort_type) {
                return $query->orderBy($sort_col, $sort_type);
            })->limit($limit)->get();
    }

    public static function getTransferOrders($customer_id, $status = null, $pageing = 0)
    {
        $list = TransferWithdrawOrder::
        with([
            'agencyCountry.country:id,name', 'agencyCountry.transferAgency:id,agency_name'
            , 'currency:id,name',
        ])
            ->where('customer_id', $customer_id)
            ->when($status != null, function ($query) use ($status) {
                if (is_array($status)) {
                    return $query->whereIn('current_status', $status);
                }


                return $query->where('current_status', $status);
            })->orderByDesc("id");
        if ($pageing == 1) {
            return $list->paginate(3);
        }

        return $list->get();
    }

    public static function createDepositOrder($postedDate, $customer_id, $country_id, $order_type = 'normal_deposit')
    {
        try {
            $agencyInfo = self::get_deposit_agency_info($postedDate['deposit_agency_id']);
            [$clientAmount, $exchangePrice] =
                self::getClientAmount($postedDate['amount'], $postedDate['currency_id']);
            $depositOrder = new DepositOrder();
            $depositOrder->deposit_date = isset($postedDate['deposit_date'])
                ? \Carbon\Carbon::parse($postedDate['deposit_date']) : now();
            $depositOrder->op_type = 'deposit';
            $depositOrder->op_code = getTrx();
            $depositOrder->order_type = $order_type;
            $depositOrder->amount = $postedDate['amount'] ?? 0;
            $depositOrder->currency_id = \config('ytadawul.default_currency_id', 1);
            $depositOrder->client_amount = isset($postedDate['client_amount'])
                ? $postedDate['client_amount'] : $clientAmount;
            $depositOrder->exchange_price = $exchangePrice;
            $depositOrder->cl_amount_curr_id = $postedDate['currency_id'];
            $depositOrder->customer_id = $customer_id;
            $depositOrder->deposit_type = $agencyInfo->depositMethod->deposit_type;
            $depositOrder->fee_percent = $agencyInfo->deposit_fee_percent;
            $depositOrder->fee_amount = $agencyInfo->fixed_charge_deposit + ($postedDate['amount'] * $agencyInfo->deposit_fee_percent / 100);
            //how much must we receive
            $depositOrder->final_amount = $depositOrder->amount + $depositOrder->fee_amount;
            $depositOrder->agency_id = $postedDate['deposit_agency_id'];
            if ($agencyInfo->is_automatic){
                $depositOrder->current_status = 'rejected';
            }else{
                $depositOrder->current_status = 'pending';
            }
            $depositOrder->reference_id = isset($postedDate['reference_id']) ? $postedDate['reference_id'] : null;
            $created = $depositOrder->save();
            if ($created) {
                return $depositOrder;
            }

            return false;
        } catch (Exception $ex) {
            throw  new Exception($ex->getMessage());
        }
    }


    static function getClientAmount($amountInDollar, $currency_id)
    {
        if ($currency_id !== \config('ytadawul.default_currency_id', 1)) {
            $exchange_price = Currency::where('id', $currency_id)->first()
                ->exchange_price;

            return [calcExchangePriceFromDollar($amountInDollar, $exchange_price), $exchange_price];
        }

        return [$amountInDollar, 1];
    }

    static function get_deposit_agency_info($agency_id)
    {
        return DepositAgency::find($agency_id);
    }

    static function createPullEarningOrder($postedDate, $customer_id, $country_id)
    {
        try {
            $postedDate['deposit_type'] = isset($postedDate['deposit_type']) ? $postedDate['deposit_type'] : 'electronic_bank';

            return self::createDepositOrder($postedDate, $customer_id, $country_id, 'pull_earning');

            //todo record the opin customer_op
        } catch (Exception $e) {
            return false;
        }
    }

    static function createPayingProductOrder($postedDate, $customer_id, $country_code)
    {
        try {
            $postedDate['deposit_type'] = isset($postedDate['deposit_type']) ? $postedDate['deposit_type'] : 'electronic_bank';

            return self::createDepositOrder($postedDate, $customer_id, $country_code, 'paying_order');
        } catch (Exception $e) {
            return false;
        }
    }

    static function checkUserBalanceForInternalWithdraw($posted_data, $user)
    {
        $agency = DepositAgency::findOrFail($posted_data['agency_id']);
        $final_amount = $posted_data['amount'] +
            ($posted_data['amount'] * $agency->withdraw_fee_percent / 100) + $agency->fixed_charge_withdraw;

        return !($user->balanceFloat < $final_amount);
    }

    public static function createInternalWithdrawOrder($postedData, $customer_id, $country_id)
    {
        try {
            $agencyInfo = self::get_deposit_agency_info($postedData['agency_id']);
            $internalWithdrawOrder = new DepositOrder();
            $internalWithdrawOrder->op_type = 'withdraw';
            $internalWithdrawOrder->op_code = getTrx();
            $internalWithdrawOrder->order_type = 'normal_withdraw';
            $internalWithdrawOrder->amount = $postedData['amount'];
            $internalWithdrawOrder->currency_id = 1;
            $internalWithdrawOrder->customer_id = $customer_id;
            $internalWithdrawOrder->customer_finance_account =
                self::getFinanceAccountNumber($customer_id, $postedData['agency_id']);
            $internalWithdrawOrder->agency_id = $postedData['agency_id'];

            $fee_amount = $agencyInfo->fixed_charge_withdraw + ($postedData['amount'] * $agencyInfo->withdraw_fee_percent / 100);

            $internalWithdrawOrder->deposit_type = $agencyInfo->depositMethod->deposit_type;
            $internalWithdrawOrder->fee_percent = $agencyInfo->withdraw_fee_percent;
            $internalWithdrawOrder->fee_amount = $fee_amount;
            $internalWithdrawOrder->client_amount = $fee_amount + $postedData['amount'];
            $internalWithdrawOrder->cl_amount_curr_id = \config('ytadawul.default_currency_id', 1);
            $internalWithdrawOrder->final_amount = $fee_amount + $postedData['amount'];
            $internalWithdrawOrder->current_status = 'pending';
            try {
                DB::beginTransaction();
                $created = $internalWithdrawOrder->save();
                DB::commit();
            } catch (Throwable $e) {
                DB::rollBack();
                throw  new Exception('there are error :' . $e->getMessage());
            }
            if ($created) {
                return $internalWithdrawOrder;
            }

            return false;
        } catch (Exception $ex) {
            //throw  new \Exception($ex->getMessage());
            return false;
        }
    }

    static function getAgencyCountryInfo($country_id, $agency_id)
    {
        return DepositAgencyCountry::where('deposit_agency_id', $agency_id)
            ->where('country_id', $country_id)->first();
    }

    static function getFinanceAccountNumber($customer_id, $agency_id)
    {
        $acc = CustomerFinanceAccount::where('customer_id', $customer_id)
            ->where('agency_id', $agency_id)->first('customer_agency_acc_number');

        return $acc ? $acc->customer_agency_acc_number : 0;
    }


    static function getReceivingAgenciesCountries()
    {
        $countriesList = ReceivingAgenciesCountry::
        select(DB::raw('distinct(country_id)'))
            ->get()->pluck('country_id');

        $countries = Country::whereIn('id', $countriesList)
            ->where('active', 1)->get();

        return $countries ?? false;
    }


    static function getAgenciesByCountryReceiveType($country_id, $trans_type)
    {
        $agenciesList = TransferAgency::
        join('receiving_agencies_countries',
            'transfer_agencies.id', '=',
            'receiving_agencies_countries.transfer_agency_id')
            ->where('transfer_agencies.active', 1)
            ->where('receiving_agencies_countries.country_id', $country_id)
            ->where(function ($query) use ($trans_type) {
                return $query->where('transfer_agencies.receive_method', $trans_type)
                    ->orWhere('receive_method', 'both');
            })->select(['transfer_agencies.*',
                'receiving_agencies_countries.id as ra_c_id', 'transfer_fee'])
            ->get();

        return $agenciesList;
    }

    static function validateTransferPostedData($postedData, $customer_id)
    {
        $country_id = $postedData['country_id'];
        $trans_agency_id = $postedData['transfer_agency_id'];
        $amount = $postedData['amount'];
//        $currency_id           = $postedData['currency_id'];
        $currency_id = config('ytadawul.default_currency_id');;
        $resultValid['status'] = false;
        $resultValid['msg'] = t('invalid_data: ');
        $receiveInfo = ReceivingAgenciesCountry::where('country_id', $country_id)
            ->where('transfer_agency_id', $trans_agency_id)
            ->first();
        if (!$receiveInfo) {
            $resultValid['status'] = false;
            $resultValid['msg'] .= t('no correct  transfer country with agency');

            return $resultValid;
        }

        $amount = getEqualPriceInDollar($currency_id, $amount);
        $transfer_fee = ($receiveInfo->transfer_fee > 0)
            ? $receiveInfo->transfer_fee : config('ytadawul.transfer.commission');
        $amountPlusTransferFee = (float) $amount + (float) ($amount * $transfer_fee);
        $customerBalance = Customer::find($customer_id)->balanceFloat;
        if ($customerBalance < $amountPlusTransferFee) {
            $resultValid['status'] = false;
            $resultValid['msg'] .= t('no_enough_balance');

            return $resultValid;
        }
        $resultValid['status'] = true;
        $resultValid['msg'] = t('data_valid: ');
        $resultValid['data'] = $receiveInfo;

        return $resultValid;
    }

    static function doTransferWithdrawOrder($validated_data, $posted_data, $customer_id)
    {
        $fee_percent = isset($validated_data['transfer_fee'])
            ? $validated_data['transfer_fee'] : config('ytadawul.transfer.commission');
        $data_insert['amount'] = $posted_data['amount'];
        $data_insert['currency_id'] = config('ytadawul.default_currency_id');
        $data_insert['exchange_price'] = 1;
        $data_insert['fee_percent'] = $fee_percent;
        $data_insert['transfer_fee'] = $posted_data['amount'] * $fee_percent;
        $data_insert['transferred_currency_id'] = 1;
        $data_insert['transferred_amount'] = $posted_data['amount'];
        $data_insert['customer_id'] = $customer_id;
        $data_insert['receiving_mode'] = $posted_data['receiving_mode'];
        $data_insert['transfer_agency_country_id'] = $validated_data['id'];
        $data_insert['current_status'] = 'pending';
        $data_insert['receiver_acc_number'] = $posted_data['receiver_acc_number'];
        //extra cols
        $data_insert['receiver_name'] = $posted_data['receiver_name'] ?? null;
        $data_insert['receiver_phone'] = $posted_data['receiver_phone'] ?? null;
        $data_insert['receiver_email'] = $posted_data['receiver_email'] ?? null;
        $data_insert['receiver_address'] = $posted_data['receiver_address'] ?? null;
        $data_insert['receiver_other_info'] = $posted_data['receiver_other_info'] ?? null;
        try {
            DB::beginTransaction();
            $transferOrderCreated = TransferWithdrawOrder::create($data_insert);
            $amount_will_withdraw = $validated_data['amount'] + ($data_insert['transfer_fee']);
            $withdraw_trans = Customer::find($customer_id)->withdrawFloat($amount_will_withdraw);
            DB::commit();
            if (!$withdraw_trans) {
                DB::rollBack();

                return false;
            }
        } catch (Throwable $e) {
            DB::rollBack();
            throw  new Exception('there are error :' . $e->getMessage());
        }

        return $transferOrderCreated;
    }

    function getCustomerFinanceAccounts($customer_id, $ready_accounts = false)
    {
        return CustomerFinanceAccount::with('agency')
            ->join('deposit_agencies',
                "customer_finance_accounts.agency_id", "=", "deposit_agencies.id")
            ->where('is_withdraw_agency', 1)
            ->where('customer_id', $customer_id)
            ->when($ready_accounts == true, function ($q) {
                return $q->whereNotNull('customer_agency_acc_number');
            })->get();
    }

    function getCustomerFinanceAccounts3($customer_id, $ready_accounts = false)
    {
        return CustomerFinanceAccount::with('agency')
            ->join('deposit_agencies',
                "customer_finance_accounts.agency_id", "=", "deposit_agencies.id")
            ->where('is_withdraw_agency', 1)
            ->where('customer_id', $customer_id)
            ->when($ready_accounts == true, function ($q) {
                return $q->whereNotNull('customer_agency_acc_number');
            })->select('customer_finance_accounts.*', 'deposit_agencies.*', 'customer_finance_accounts.address as customer_address')->get();
    }
    
    function getCustomerFinanceAccounts2($customer_id, $ready_accounts = false)
    {
        return CustomerFinanceAccount::with('agency')
            ->join('deposit_agencies',
                "customer_finance_accounts.agency_id", "=", "deposit_agencies.id")
            ->where('is_withdraw_agency', 1)
            ->where('customer_id', $customer_id)
            ->when($ready_accounts == true, function ($q) {
                return $q->whereNotNull('customer_agency_acc_number');
            })->select('customer_finance_accounts.*', 'deposit_agencies.id as deposit_agency', 'deposit_agencies.img_path as img_path')->get();
    }

    function getPaymentsGateWayForPlatform($platformId)
    {
        $agenciesList = DepositAgency::
        join('freelancing_platforms_deposit_agencies',
            'deposit_agencies.id', '=',
            'freelancing_platforms_deposit_agencies.deposit_agency_id')
            ->where('freelancing_platforms_deposit_agencies.freelancing_platform_id', $platformId)
            ->where('active', 1)
            ->select(['deposit_agencies.*', 'freelancing_platforms_deposit_agencies.id as f_p_d_id'])
            ->get();

        return $agenciesList;
    }

    public function createPayingOrder($customer_id, $postedData)
    {

        return PayingOrder::create([
            'customer_id'        => $customer_id,
            'product_name'       => $postedData['product_name'],
            'link_url'           => $postedData['link_url'],
            'paying_date'        => isset($postedData['paying_date']) ? $postedData['paying_date'] : null,
            'product_price'      => $postedData['product_price'],
            'real_price'         => $postedData['product_price'],
            'final_price'        => $postedData['product_price']
                + (intval($postedData['product_price']) * Config::get('settings.paying_orders_comms', 0)),
            'currency_id'        => 1,
            'commission_percent' => config('ytadawul.pay_order.commission'),
            'commission_fee'     => config('ytadawul.pay_order.commission') * $postedData['product_price'],
            'description'        => isset($postedData['description']) ? $postedData['description'] : null,
            'current_status'     => 'pending',
        ]);
    }

    public static function confirmPaynigOrderWithdraw($customer_id, PayingOrder $orderInfo)
    {

        if ($orderInfo->customer_id != $customer_id) {
            throw new Exception('this order not for this user');
        }
        if ($orderInfo->withdraw_id > 0 && DepositOrder::find($orderInfo->withdraw_id)) {
            throw new Exception('this order related to withdraw order');
        }
        try {
            $internalWithdrawOrder = new DepositOrder();
            $internalWithdrawOrder->op_type = 'withdraw';
            $internalWithdrawOrder->op_code = getTrx();
            $internalWithdrawOrder->order_type = 'paying_order';
            $internalWithdrawOrder->amount = $orderInfo->product_price;
            $internalWithdrawOrder->currency_id = 1;
            $internalWithdrawOrder->customer_id = $customer_id;
            $internalWithdrawOrder->deposit_type = 'bank_deposit'; //deprecated
            $internalWithdrawOrder->fee_percent = $orderInfo->commission_percent;
            $internalWithdrawOrder->fee_amount = $orderInfo->commission_percent * $orderInfo->product_price;
            $internalWithdrawOrder->final_amount = $orderInfo->final_price;
            $internalWithdrawOrder->current_status = 'confirmed';
            $internalWithdrawOrder->status_note = 'this withdrawal did as confirming paying order';
            $internalWithdrawOrder->reference_id = $orderInfo->id;
            $created = $internalWithdrawOrder->save();
            if ($created) {
                return $internalWithdrawOrder;
            }

            throw  new Exception('we cant create this withdrawal');
        } catch (Exception $ex) {
            throw  new Exception($ex->getMessage());

        }
    }

    public function payWithPayeer($order)
    {
        $m_shop = config('payeer.merchant_ID'); // merchant ID
        $m_orderid = $order->id; // invoice number in the merchant's invoicing system
        $m_amount = number_format($order->final_amount, 2, '.', ''); // invoice amount with two decimal places following a period
        $m_curr = $order->currency->code; // invoice currency
        $m_desc = base64_encode($order->order_type); // invoice description encoded using a base64 algorithm
        $m_key = config('payeer.merchant_key'); //'xpsMSlhONEitd0K3';
        // Forming an array for signature generation
        $arHash = [
            $m_shop,
            $m_orderid,
            $m_amount,
            $m_curr,
            $m_desc,
        ];
//        // Forming an array for additional parameters
//        $arParams = array(
//            'success_url' => config('app.url')  . '/payeer-success-callback',
//            'fail_url'    => config('app.url')  . '/payeer-fail-callback',
//            'status_url'  => config('app.url')  . '/payeer-status',
//        );
//
//        $key = md5(config('payeer.encryption_additional_param').$m_orderid);
//        
//        $m_params = urlencode(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, json_encode($arParams), MCRYPT_MODE_ECB)));
//
//        $iv = substr(hash('sha256', $key), 0, 16);
//        $m_params = urlencode(base64_encode(openssl_encrypt(json_encode($arParams),
//            'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv)));
//
//        $arHash[] = $m_params;
//        
        // Adding the secret key to the signature-formation array
        $arHash[] = $m_key;
        // Forming a signature
        $sign = strtoupper(hash('sha256', implode(':', $arHash)));
        $arGetParams = array(
            'm_shop'    => $m_shop,
            'm_orderid' => $m_orderid,
            'm_amount'  => $m_amount,
            'm_curr'    => $m_curr,
            'm_desc'    => $m_desc,
            'm_sign'    => $sign,
//            'm_params'  => $m_params,
            //'m_cipher_method' => 'AES-256-CBC-IV',
            //'form[ps]' => '2609',
            //'form[curr[2609]]' => 'USD',
        );
        return 'https://payeer.com/merchant/?' . http_build_query($arGetParams);
    }
}
