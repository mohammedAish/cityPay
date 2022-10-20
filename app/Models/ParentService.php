<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class ParentService extends BaseModel
{
    use CrudTrait;// Sluggable, SluggableScopeHelpers;

    use HasTranslations;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'parent_services';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];
    public $translatable = ['name','description',/*'img_path'*/];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    //@todo in future
    /* public function sluggable(){
         return [
             'slug' => [
                 'source' => 'name',
             ],
         ];
     }*/

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function services(){
        return $this->hasMany(Service::class,"parent_service_id","id");
    }

    public function serviceFeatures(){
        return $this->hasMany(ServiceFeature::class,'parent_service_id','id');
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
    public function setImgPathAttribute($value){
        $attribute_name = "img_path";
        // or use your own disk, defined in config/filesystems.php
        $disk = config('backpack.base.root_disk_name');
        // destination path relative to the disk above
        $destination_path = "public/storage/services";
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


    public function servicesBtn($xPanel = false){
        $url = admin_url('parentservice/'.$this->id.'/service');

        $msg     = trans('lang.child_services',['service' => $this->name]);
        $toolTip = ' data-toggle="tooltip" title="'.$msg.'"';

        $out = '';
        $out .= '<a class="btn btn-sm btn-link pr-0" href="'.$url.'"'.$toolTip.'>';
        $out .= '<i class="fa fa-eye"></i> ';
        $out .= mb_ucfirst(trans('lang.child_services'));
        $out .= '</a>';

        return $out;
    }
    public function featuresBtn($xPanel = false){
        $url = admin_url('parentservice/'.$this->id.'/servicefeature');

        $msg     = trans('lang.servicefeature',['service' => $this->name]);
        $toolTip = ' data-toggle="tooltip" title="'.$msg.'"';

        $out = '';
        $out .= '<a class="btn btn-sm btn-link pr-0" href="'.$url.'"'.$toolTip.'>';
        $out .= '<i class="fa fa-eye"></i> ';
        $out .= mb_ucfirst(trans('lang.service_features'));
        $out .= '</a>';

        return $out;
    }





}
