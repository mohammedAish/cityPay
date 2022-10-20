<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class PayingOrder extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'paying_orders';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = [
        'customer_id', 'product_name', 'paying_date', 'product_price', 'currency_id',
        'commission_percent', 'commission_fee', 'description','real_price','final_price',
        'link_url', 'file_path', 'current_status', 'admin_id', 'admin_note','last_edited_by'
    ];
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

    public function depositOrder() {
        return $this->hasOne(DepositOrder::class, 'withdraw_id', 'id');
    }
    public function currency() {
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }

    public function admin() {
        return $this->belongsTo(User::class, 'admin_id', 'id');
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
