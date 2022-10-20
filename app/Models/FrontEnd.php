<?php

namespace App\Models;

use App\Models\Scopes\LanguageScope;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class FrontEnd extends BaseModel
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'frontends';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];
    protected $fillable = ['data_keys', 'lang_code', 'data_values'];

    protected $casts = [
        'data_values' => 'object'
    ];

    public function getKeyAttribute() {
        return $this->data_keys;
    }

    public function getValueAttribute() {
        return $this->data_values;
    }

    public static function scopeGetContent($key) {
        return Frontend::where('data_keys', $key);
    }

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    protected static function boot() {
        parent::boot();
        static::addGlobalScope(new LanguageScope());
    }
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

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
