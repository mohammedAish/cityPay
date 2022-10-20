<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Str;

class Consultant extends BaseModel
{
    use CrudTrait,HasTranslations;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */
    //todo any order has hour and price per hour
    protected $table = 'consultants';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];
    public $translatable = ['name','description',/*'img_path'*/];

    //this static constants
    public $attributes = [
        'service_id'         => 4,
        'service_package_id' => 1,
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

    public function customers(){
        return $this->belongsToMany(Customer::class,"customer_consultants_orders"
            ,'consultant_id',"customer_id");
    }

    public function comments():MorphMany{
        return $this->morphMany(Comment::class,'commentable');
    }

    public function category(){
        return $this->belongsTo(ConsultantsCategory::class,'consultants_category_id','id');
    }

    public function currency(){
        return $this->belongsTo(Currency::class,'currency_id','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder|Model|object
     * static relation
     */
    /*  public function service() {
          return Service::where('id',4)->first();
      }*/
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

    public function setImgPathAttribute($value){
        $attribute_name = "img_path";
        // or use your own disk, defined in config/filesystems.php
        $disk = config('backpack.base.root_disk_name');
        // destination path relative to the disk above
        $destination_path = "public/storage/consultants";
        // if the image was erased
        if ($value == null) {
            // delete the image from disk
            \Storage::disk($disk)->delete($this->{$attribute_name});

            // set null in the database column
            $this->attributes[$attribute_name] = null;
        }
        // if a base64 was sent, store it in the db
        if (Str::startsWith($value,'data:image')) {
            // 0. Make the image
            $image = \Image::make($value)->encode('png',90);
            // 1. Generate a filename.
            $filename = md5($value.time()).'.png';

            // 2. Store the image on disk.
            \Storage::disk($disk)->put($destination_path.'/'.$filename,$image->stream());

            // 3. Delete the previous image, if there was one.
            \Storage::disk($disk)->delete($this->{$attribute_name});

            // 4. Save the public path to the database
            // but first, remove "public/" from the path, since we're pointing to it
            // from the root folder; that way, what gets saved in the db
            // is the public URL (everything that comes after the domain name)
            $public_destination_path           = Str::replaceFirst('public/','',$destination_path);
            $this->attributes[$attribute_name] = $public_destination_path.'/'.$filename;

            return $this->attributes['img_path'];
        }
    }
}
