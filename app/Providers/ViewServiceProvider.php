<?php

namespace App\Providers;

use App\View\Composers\NotificationComposer;
use App\View\Composers\UserStatusVerificationComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts.wallet.navbar', NotificationComposer::class);
    }
}
