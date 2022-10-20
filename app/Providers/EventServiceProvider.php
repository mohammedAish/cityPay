<?php

namespace App\Providers;

use App\Events\CustomerYTWalletChangedEvent;
use App\Events\CustomerWasLoged;
use App\Events\ServiceOrderCreated;
use App\Events\WalletTransactionEvent;
use App\Listeners\CreateChatUser;
use App\Listeners\IncreaseYTadawulWallet;
use App\Listeners\RegisterCustomerService;
use App\Listeners\UpdateCustomerLastLogin;
use App\Listeners\UpdateCustomerWalletCode;
use App\Listeners\UpdateTransactionTableListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class                   => [
            SendEmailVerificationNotification::class,
            UpdateCustomerWalletCode::class,
            CreateChatUser::class
        ],
        CustomerWasLoged::class             => [
            UpdateCustomerLastLogin::class,
        ],
        WalletTransactionEvent::class       => [UpdateTransactionTableListener::class],
        CustomerYTWalletChangedEvent::class => [IncreaseYTadawulWallet::class],
        //todo enable it
        //ServiceOrderCreated::class=>[RegisterCustomerService::class]

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot() {
        parent::boot();
        //
    }
}
