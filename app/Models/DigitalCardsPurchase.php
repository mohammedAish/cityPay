<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class DigitalCardsPurchase extends BaseModel
{
    use CrudTrait;//we dont need translate here
    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'digital_cards_purchases';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    protected $dates = [
        'purchase_date' => 'date',
    ];

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
    public function currency(){
        return $this->belongsTo(Currency::class,"currency_id","id");
    }

    public function invoiceItems()
    {
        return $this->belongsToMany(DigitalCard::class,
            'd_cards_purchases_details',
            'digital_cards_purchase_id', 'digital_card_id');
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
    public function detailsBtn(){
        $url = admin_url('digitalcardspurchase/'.$this->id.'/dcardspurchasesdetail');

        $msg     = trans('lang.purchases_detail',['details' => $this->id]);
        $toolTip = ' data-toggle="tooltip" title="'.$msg.'"';
        $out     = '';
        $countFields = $this->invoiceItems->count();
        $out     .= '<a class="btn btn-sm btn-link pr-0" href="'.$url.'"'.$toolTip.'>';

        $out     .= '<i class="fa fa-eye"></i> ';
        $out     .= mb_ucfirst(trans('lang.purchases_detail'));
        $out .= ' ('.$countFields . ') ';
        $out     .= '</a>';

        return $out;
    }
}
