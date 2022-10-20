<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class CustomerSPOps extends BaseModel
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'customer_s_p_ops';
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
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer(){
        return $this->belongsTo(Customer::class,"customer_id",'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function servicePackage(){
        return $this->belongsTo(ServicesPackage::class,
            "service_package_id","id");
    }

    /**
     * any custSOp has one record that save the points
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function loyaltyPoint(){
        return $this->hasOne(CustomersLoyaltyPointsPrice::class,"customer_s_p_ops_id","id");
    }

    /**
     * this when the service ordered such pull earnings from net or buy from net
     * @return MorphOne
     */
    public function loyalties():MorphOne{
        return $this->morphOne(CustomersLoyaltyPointsPrice::class,'loyaltyable');
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
