<?php

namespace App\Listeners;

use Bavix\Wallet\Interfaces\WalletFloat;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateCustomerWalletCode
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
    public function handle(Registered $event) {
        if ($event->user instanceof WalletFloat) {
            $event->user->wallet_code = generateWalletCode();
            $event->user->save();
        }
    }
}
