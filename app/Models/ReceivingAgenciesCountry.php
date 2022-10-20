<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class ReceivingAgenciesCountry extends BaseModel
{
    use CrudTrait,HasTranslations;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'receiving_agencies_countries';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];
    public $translatable = ['description'];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function getCountryHtml(){
        if (isset($this->country) and !empty($this->country)) {
            return $this->country->name;
        } else {
            return $this->country_id;
        }
    }

    public function getTransferAgencyHtml(){
        if (isset($this->transferAgency) and !empty($this->transferAgency)) {
            return $this->transferAgency->agency_name;
        } else {
            return $this->transfer_agency_id;
        }
    }

    /*
   |--------------------------------------------------------------------------
   | RELATIONS
   |--------------------------------------------------------------------------
   */
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country(){
        return $this->belongsTo(Country::class,"country_id","id");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transferAgency(){
        return $this->belongsTo(TransferAgency::class,"transfer_agency_id","id");
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
