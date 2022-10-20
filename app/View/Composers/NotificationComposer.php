<?php

namespace App\View\Composers;

use App\Numero\Enums\InvoiceStatus;
use App\Numero\Enums\UserStatusTypes;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class NotificationComposer
{

    public function __construct()
    {
    }

    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('notifications', auth()->user()->unreadNotifications);
    }
}