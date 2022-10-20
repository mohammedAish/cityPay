<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Support\Facades\Redirect;
use Prologue\Alerts\Facades\Alert;


class ServicesPackage extends BaseModel
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'services_packages';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];


    public $attributes =
        [
            'package_id'  => 1,
            'currency_id' => 1,
        ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function save(array $options = []){
        if (!isset($this->id)) {
            $founded_before = ServicesPackage::where('service_id',$this->service_id)->first();
            if ($founded_before) {
                Alert::error(trans('لقد ادخلت نقاط ولاء هذة الخدمة'))->flash();
                return Redirect::back()->withInput();
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
    public function services(){
        return $this->belongsTo(Service::class,"service_id","id");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @deprecated
     */
    /*public function packageCategory(){
        return $this->belongsTo(PackagesCategory::class,"package_id","id");
    }*/
    public function currency(){
        return $this->belongsTo(Currency::class,'currency_id','id');
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
