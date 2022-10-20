<?php

namespace App\Listeners;

use App\Events\CustomerWasLoged;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Carbon;

class UpdateCustomerLastLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(CustomerWasLoged $event)
    {
        $event->customer->last_login_at = Carbon::now();
        $event->customer->save(['canBeSaved' => true]);
    }
}
