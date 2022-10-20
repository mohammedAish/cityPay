<?php

namespace App\Models;

use App\Models\Scopes\ConfirmedScope;
use App\Observers\DepositOrderObserver;


class DepositOrderCompleted extends DepositOrder
{


    public static function boot(){
        parent::boot();
        DepositOrderCompleted::observe(DepositOrderObserver::class);
    }

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
