<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;

class TransferAgency extends BaseModel
{
    use CrudTrait,HasTranslations;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'transfer_agencies';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];
    public $translatable = ['agency_desc','agency_name',/*'img_path'*/];
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function countries(){
        return $this->belongsToMany(Country::class,"receiving_agencies_countries"
            ,"transfer_agency_id","country_id");
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
        $destination_path = "public/storage/Agencies";
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

    public function transferAgencyFeeBtn($xPanel = false){
        $url = admin_url('transferagency/'.$this->id.'/fee_countries');

        $msg     = trans('lang.provider_packages',['packages' => $this->name]);
        $toolTip = ' data-toggle="tooltip" title="'.$msg.'"';
        $out     = '';
        $out     .= '<a class="btn btn-sm btn-link pr-0" href="'.$url.'"'.$toolTip.'>';
        $out     .= '<i class="fa fa-eye"></i> ';
        $out     .= mb_ucfirst(trans('lang.fee_transfer_countries'));
        $out     .= '</a>';

        return $out;
    }
}
