<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class CustomerConsultantOrder extends BaseModel
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'customer_consultants_orders';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = [
        'customer_id',
        'consultant_id',
        'price',
        'is_open',
        'current_status',
        'currency_id',
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
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer(){
        request()->all();
        return $this->belongsTo(Customer::class,'customer_id','id');
    }

    public function consultant(){
        return $this->belongsTo(Consultant::class,'consultant_id','id');
    }

    /**
     * سيكون له نقاط ولاء جراء شرائه للاستشارة
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
    public function proceduresBtn($xPanel = false){
        $url = admin_url('customerconsultantorder/'.$this->id.'/consultantorderprocedure');

        $msg     = trans('lang.consultant_proc',['consultantorder' => $this->name]);
        $toolTip = ' data-toggle="tooltip" title="'.$msg.'"';

        $out = '';
        $out .= '<a class="btn btn-xs btn-light" href="'.$url.'"'.$toolTip.'>';
        $out .= '<i class="fa fa-eye"></i> ';
        $out .= mb_ucfirst(trans('lang.consultant_proc'));
        $out .= '</a>';

        return $out;
    }
}
