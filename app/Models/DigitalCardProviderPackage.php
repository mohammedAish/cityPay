<?php

namespace App\Models;

use App\Observers\DigitalCardProviderPackageObserver;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class DigitalCardProviderPackage extends BaseModel
{
    use CrudTrait,HasTranslations;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'd_c_provider_packages';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];
    public $translatable = ['name'];
    protected $attributes = [
        'currency_id' => 1,
        'price'       => 1,
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public static function boot(){
        parent::boot();
        DigitalCardProviderPackage::observe(DigitalCardProviderPackageObserver::class);
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function provider(){
        return $this->belongsTo(DigitalCardsProvider::class,"d_card_provider_id","id");
    }

    public function store(){
        return $this->belongsTo(DigitalCardStore::class,"store_id","id");
    }

    public function currency(){
        return $this->belongsTo(Currency::class,"currency_id","id");
    }

    public function digitalCard(){
        return $this->hasOne(DigitalCard::class,"d_c_package_id","id");
    }


    /* public function providerPackage(){
         return $this->belongsTo(DigitalCardProviderPackage::class,"d_c_package_id","id");
     }*/

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    public function scopeDistinctInDigitalCard($query){
        $current_ids = DigitalCard::select('d_c_package_id')->distinct()->get()->pluck('d_c_package_id');

        return $query->whereNotIn('id',[1,2,3,4]);
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */
    public function getProviderStorePackageNameAttribute(){
        return isset($this->store) && !empty($this->store)
        && isset($this->provider) && !empty($this->provider)
            ? $this->provider->name.'-'.$this->store->name.'-'.$this->name
            :$this->name;
    }

    public function getExpireDaysHtml(){
        if (isset($this->attributes['expire_days'])) {
            return $this->expire_days <=0?trans('lang.unlimited')
                :(($this->expire_days >10) ?$this->expire_days.trans('lang.day'):$this->expire_days.trans('lang.days'));
        }

        return null;
    }
    public function getUpdatedAtHtml(){
        if (isset($this->attributes['updated_at'])) {
            return $this->updated_at->diffForHumans().'('.$this->updated_at->format('H:i d-m-Y').')';
        }
        return null;
    }


    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
