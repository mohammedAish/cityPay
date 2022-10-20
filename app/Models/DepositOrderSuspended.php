<?php

namespace App\Models;

use App\Models\Scopes\SuspendedScope;
use App\Observers\DepositOrderObserver;
use App\Observers\SuspendedDepositOrderObserver;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class DepositOrderSuspended extends DepositOrder
{


    public static function boot(){
        parent::boot();
        DepositOrderSuspended::observe(DepositOrderObserver::class);
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
