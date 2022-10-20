<?php

namespace App\Listeners;

use App\Models\Customer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IncreaseYTadawulWallet
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct() {

    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event) {
        $depositWithdraw = $event->depositOrder;
        $YTDAWULUSER     = Customer::find(config('ytadawul.wallet_user_id'));
        if ($depositWithdraw->op_type == 'deposit') {


            $winAmount = (float) $depositWithdraw->fee_amount;
            $meta      = [
                'op_type'       => $depositWithdraw->op_type,
                'order_type'    => $depositWithdraw->order_type,
                'from_customer' => $depositWithdraw->customer_id,
                'order_id'      => $depositWithdraw->id,
            ];
        } elseif ($depositWithdraw->op_type == 'withdraw') {
            //mean the amount that will reciev the customer is final_amount
            /*            $winAmount = $depositWithdraw->final_amount - $depositWithdraw->amount;*/

            $winAmount = (float) $depositWithdraw->fee_amount;
            $meta      = [
                'op_type'       => $depositWithdraw->op_type,
                'order_type'    => $depositWithdraw->order_type,
                'from_customer' => $depositWithdraw->customer_id,
                'order_id'      => $depositWithdraw->id
            ];
        }
        $YTDAWULUSER->depositFloat($winAmount, $meta);


    }
}
