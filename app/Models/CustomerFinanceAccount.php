<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;

class CustomerFinanceAccount extends BaseModel
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'customer_finance_accounts';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
//     protected $fillable = [
//         'customer_id', 'agency_id', 'agency_name', 'customer_agency_acc_number','customer_agency_acc_name'
//     ];
    // protected $hidden = [];
    // protected $dates = [];

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
    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id','id');
    }


    public function agency(){
        return $this->belongsTo(DepositAgency::class,"agency_id","id");
    }
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
