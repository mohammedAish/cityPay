<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class DepositAgencyCountry extends BaseModel
{
    use CrudTrait,HasTranslations;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'deposit_agency_countries';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];
    public $appends = [];// ['name_agency_country'];
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

    public function getDepositAgencyHtml(){
        if (isset($this->depositAgency) and !empty($this->depositAgency)) {
            return $this->depositAgency->name;
        } else {
            return $this->deposit_agency_id;
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
    public function depositAgency(){
        return $this->belongsTo(DepositAgency::class,"deposit_agency_id","id");
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
    public function getNameAgencyCountryAttribute(){
        return isset($this->country)&& !empty($this->country)?
            $this->country->name.'-'.$this->depositAgency->name
            :$this->depositAgency->name;
    }
}
