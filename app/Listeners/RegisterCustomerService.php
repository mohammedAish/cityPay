<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RegisterCustomerService
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
    public function handle($event){
        /*
         * 'normal_deposit','normal_withdraw','pull_earning','paying_order'
         */
        //todo complete register the service loyalty points
        switch ($event->service_type) {
            case 'normal_deposit':
            {
            }
            case 'normal_withdraw':
            {
            }
            case 'pull_earning':
            {
            }
            case 'paying_order':
            {
            }
        }
    }
}
