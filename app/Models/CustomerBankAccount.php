<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class CustomerBankAccount extends BaseModel
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'customer_banking_accounts';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
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


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function countryAgencyBankCountry(){
        return $this->belongsTo(ReceivingAgenciesCountry::class,'receiving_agencies_country_id','id');
    }
    /**
     * currency belongs to
     */
    public function currency(){
        return $this->belongsTo(Currency::class,"currency_id","id");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lovers(){
        return $this->hasMany(CustomerLoverBankAccount::class,'customer_id','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country(){
        return $this->belongsTo(Country::class,"country_code","code");
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
