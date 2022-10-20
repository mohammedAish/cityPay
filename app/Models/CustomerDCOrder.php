<?php

namespace App\Models;

use App\Models\Traits\StatusTrait;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class CustomerDCOrder extends BaseModel
{
    use CrudTrait,StatusTrait;//dont use translation here

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'customer_d_c_orders';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = ['customer_id','current_status','total_amount','customer_hint','admin_note'];
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
     * to get the DCards that the customer bought it
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function digitalCardsBought(){
        return $this->hasMany(DCardsPurchasesDetail::class,"customer_d_c_order_id","id")
            ->select('digital_card_id','card_code','sell_price','customer_d_c_order_id','assign_date','assigned_type');
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
