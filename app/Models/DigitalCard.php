<?php

namespace App\Models;

use App\Observers\DigitalCardObserver;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Prologue\Alerts\Facades\Alert;

class DigitalCard extends BaseModel
{
    use CrudTrait;
    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'digital_cards';
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
    /*  public static function boot(){
          parent::boot();
          DepositOrder::observe(DigitalCardObserver::class);
      }*/

    public function save(array $options = []){
        $package_id = $this->d_c_package_id;
        if ($package_id) {
            //check if found before
            if (!$this->id && $founded = DigitalCard::where('d_c_package_id',$package_id)->first()) {
                return Alert::error('لقد قمت باضافة هذا الكرت من قبل')->flash();
            }
            //save info
            $packageInfo = DigitalCardProviderPackage::where('id',$package_id)->first();
            if ($packageInfo) {
                $this->store_id    = DigitalCardStore::find($packageInfo->store_id)->id;
                $this->provider_id = DigitalCardsProvider::find($packageInfo->d_card_provider_id)->id;
            }
        }

        return parent::save($options);
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function provider(){
        return $this->belongsTo(DigitalCardsProvider::class,"provider_id","id");
    }

    public function store(){
        return $this->belongsTo(DigitalCardStore::class,"store_id","id");
    }

    /**
     * must be has one
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function providerPackage(){
        return $this->belongsTo(DigitalCardProviderPackage::class,"d_c_package_id","id");
    }

    public function providerPackageDistinct(){
        return $this->belongsTo(DigitalCardProviderPackage::class,"d_c_package_id",
            "id")->distinctInDigitalCard();
    }




    /*public function currency(){
        return $this->belongsTo(Currency::class,"currency_id","id");
    }    */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function purchaseDetails(){
        return $this->hasMany(DCardsPurchasesDetail::class,"digital_card_id","id");
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderDetails(){
        return $this->hasMany(CustomerDCOrderDetail::class,"digital_card_id","id");
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
    public function getProviderPackageNameHtml(){
        if (isset($this->attributes['d_c_package_id'])) {
            $providerPackageName = $this->provider->name.'-'.
                $this->store->name.'-'.$this->providerPackage->name;

            return $providerPackageName;
        }

        return isset($this->store) && !empty($this->store)
        && isset($this->provider) && !empty($this->provider)
            ? $this->provider->name.'-'.$this->store->name
            :$this->name;
    }

    //provider_store_package_name
    public function getProviderStorePackageNameAttribute(){
        return isset($this->store) && !empty($this->store)
        && isset($this->provider) && !empty($this->provider)
        && isset($this->providerPackage) && !empty($this->providerPackage)
            ? $this->provider->name.'-'.$this->store->name.'-'.$this->providerPackage->name
            :$this->name;
    }
}
