<?php


namespace App\Models\Traits;


use App\Events\CustomerYTWalletChangedEvent;
use App\Events\WalletTransactionEvent;
use App\Models\Customer;
use App\Models\DepositOrder;
use App\Models\ReceivingAgenciesCountry;
use App\Notifications\OrderNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;

trait WalletModelTrait
{
    function checkIsEqualOriginal($id, $model, $value_compared): bool {
        $current_model   = $model::find($id);
        $accepted_before = false;
        if (!$current_model) {
            return false;
        }
        if ($current_model->current_status == $value_compared) {
            $accepted_before = true;
        }

        return $accepted_before;
    }

    public static function execRelatedDepositOps(array $postedData) {

        $meta_data['deposit_date'] = !empty($postedData['deposit_date'])
            ? $postedData['deposit_date'] : null;
        $meta_data['op_type']      = $postedData['op_type'];
        $meta_data['status_note']  = $postedData['status_note'];
        $meta_data['admin_id']     = $postedData['admin_id'];
        $meta_data['currency_id']  = $postedData['currency_id'];
        $meta_data['amount']       = $postedData['amount'];


        if ($postedData['op_type'] == 'deposit') {
            $depositTrx = Customer::find($postedData['customer_id'])
                ->depositFloat($postedData['amount'], $meta_data);

            //register the trans info
            Event::dispatch(new WalletTransactionEvent(
                $depositTrx, 'deposit_order', $postedData['id']));
            //todo ZAHER Must record the comms that comes from this op
            //record the comms for YTADAWULUSER
            $order = new DepositOrder();
            $order->fill($postedData);
            Event::dispatch(new CustomerYTWalletChangedEvent($order));


            $order->customer->notify(new OrderNotification($order));
        }

        return $depositTrx;
    }

    public static function execWithdrawWallet(DepositOrder $orderCreated) {
        try {
            DB::beginTransaction();
            $withdraw_trx = Customer::find($orderCreated->customer_id)
                ->withdrawFloat($orderCreated->client_amount, $orderCreated->toArray(), true);
            //update the wallet table
            Event::dispatch(new WalletTransactionEvent($withdraw_trx, 'withdraw_order', $orderCreated->id));

            \DB::commit();
        } catch (\Exception $ex) {
            \DB::rollBack();
            throw new \Exception('error '.$ex->getMessage());
        }

        return $orderCreated;
    }


    public static function updateWalletTrxToConfirmed(array $postedData) {

        //@todo try it
        //record the comms for YT ADAWULUSER
        $customer= Customer::find($postedData['customer_id']);
        $customerWallet=$customer->wallet;
        $depositTrx     = $customerWallet->transactions()
            ->where('reference_type', 'withdraw_order')
            ->where('reference_id', $postedData['id'])
            ->first();
        if ($depositTrx) {
            $depositTrx->confirmed = 1;
            $depositTrx->save();
        }
        $order = new DepositOrder();
        $order->fill($postedData);

        Event::dispatch(new CustomerYTWalletChangedEvent($order));
        $customer->notify(new OrderNotification($order));

        return $postedData;
    }

    public static function doReTheWithdrawal(array $postedData) {

        $customerWallet = Customer::find($postedData['customer_id'])->wallet;
        $depositTrx     = $customerWallet->transactions()
            ->where('reference_type', 'withdraw_order')
            ->where('reference_id', $postedData['id'])
            ->first();
        if ($depositTrx) {
            $customerWallet->depositFloat($depositTrx->amount / 100);
        } else {
            $sum_redeposit = (float) $postedData['fee_amount'] + (float) $postedData['amount'];
            $customerWallet->depositFloat($sum_redeposit);
        }
        $meta = [
            'op_type'       => $postedData['op_type'],
            'order_type'    => $postedData['order_type'],
            'from_customer' => $postedData['customer_id'],
            'order_id'      => $postedData['id'],
        ];
        //WITHDRAW THE COMMS FROM YTUSER
        $YTDAWULUSER = Customer::find(config('ytadawul.wallet_user_id'));
        $YTDAWULUSER->withdrawFloat($postedData['fee_amount'], $meta);
        return $postedData;
    }


    //for transfer
    public static function checkTransferAmounts($posted_data): bool {
        if ($posted_data['currency_id'] == $posted_data['transferred_currency_id']) {
            if ($posted_data['transferred_amount'] > $posted_data['amount']) {
                return false;
            }
        } else {
            $posted_data['amount']             = getEqualPriceInDollar($posted_data['currency_id'],
                $posted_data['amount']);
            $posted_data['transferred_amount'] = getEqualPriceInDollar($posted_data['transferred_currency_id'],
                $posted_data['amount']);
            if ($posted_data['transferred_amount'] > $posted_data['amount']) {
                return false;
            }
        }

        return true;
    }


    public static function execTransfer(array $postedData) {
        $meta_data['transfer_fee'] = $postedData['transfer_fee'];
        $meta_data['admin_id']     = $postedData['admin_id'];
        $meta_data['currency_id']  = $postedData['currency_id'];

        $agencyInfo                     = ReceivingAgenciesCountry::find($postedData['transfer_agency_country_id']);
        $meta_data['country_id']        = $agencyInfo->country_id;
        $meta_data['deposit_agency_id'] = $agencyInfo->transfer_agency_id;
        if ($postedData['transferred_currency_id'] != config('ytadawul.default_currency_id')) {
            $currencyValue                    = \App\Models\Currency::where('id',
                $postedData['transferred_currency_id'])->first()->exchange_price;
            $postedData['transferred_amount'] = calcExchangePriceInDollar($currencyValue, $postedData['amount']);
            $meta_data['exchange_price']      = $currencyValue;
        }
        $meta_data['transferred_currency_idIndex'] = $postedData['transferred_currency_idIndex'];
        $meta_data['amount']                       = $postedData['amount'];
        $meta_data['transferred_amount']           = $postedData['transferred_amount'];
        $depositTrx                                = Customer::find($postedData['customer_id'])
            ->withdrawFloat($postedData['transferred_amount'], $meta_data);

        return $depositTrx;
    }

    public function doReDepositTheWithdrawal($withdrawal_id, $customer_id) {

        //todo ZAHER re deposit the withdrawl to user
    }
}