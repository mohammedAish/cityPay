<?php

namespace App\Listeners;

use App\Events\WalletTransactionEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateTransactionTableListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(){
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     *
     * @return void
     */
    public function handle(WalletTransactionEvent $event){
        $event->transaction->reference_type = $event->reference_type;
        $event->transaction->reference_id   = $event->reference_id;
        $event->transaction->save();
    }
}
