<?php


namespace App\Models\Traits;


use App\Models\Currency;
use App\Models\Customer;
use App\Models\DepositAgency;
use App\Models\DepositAgencyCountry;
use App\Models\FreelancingPlatform;
use Illuminate\Support\Str;

trait DepositWithdrawTrait
{

    /*
  |--------------------------------------------------------------------------
  | RELATIONS
  |--------------------------------------------------------------------------
  */
    public function customer() {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function currency() {
        return $this->belongsTo(Currency::class, "currency_id", "id");
    }

    public function currencyClient() {
        return $this->belongsTo(Currency::class, "cl_amount_curr_id", "id");
    }

    //deprecated  must be relation in pull earnings
    public function freelance() {
        return $this->belongsTo(FreelancingPlatform::class, "reference_id", "id");
    }

    public function agencyCountry() {
        return $this->belongsTo(DepositAgencyCountry::class,
            'deposit_agency_country_id', "id")->with('country');
    }

    public function agency() {
        return $this->belongsTo(DepositAgency::class, 'agency_id', "id");
    }
    //todo
    /*public function countryName(){
        $id = $this->agencyCountry;
    }*/
    /**
     * عندما يتم معالجةالعملية تتسجل عملية المعالجة تلقائيا
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function DepositWithdrawProcesses() {
        // return $this->morphOne(DepositWithdrawProcess::class, 'processable');
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
    public function getAgencyNameHtml() {
        if (isset($this->attributes['deposit_agency_country_id'])) {
            /* $agency_country = $this->agencyCountry;
             $agency_country = $agency_country->country->name.' -'.
                 $agency_country->depositAgency->name;
             return $agency_country;*/
            return $this->agency ? $this->agency->name : (null);
        }
    }

    function getFeePercentHtml() {
        if (isset($this->attributes['fee_percent']) && isFromAdminPanel()) {
            return $this->attributes['fee_percent'].' %';
        }
        return null;
    }
    function getFreelancingPlatformHtml() {
        if (isset($this->attributes['fee_percent']) && isFromAdminPanel()) {
            return $this->attributes['fee_percent'].' %';
        }
        return null;
    }

    public function getCreatedAtHtml() {
        if (isset($this->attributes['created_at'])) {
            return $this->created_at->diffForHumans();
        }

        return null;
    }

    public function setImgPathAttribute($value) {
        $attribute_name = "img_path";
        // or use your own disk, defined in config/filesystems.php
        $disk = config('backpack.base.root_disk_name');
        // destination path relative to the disk above
        $destination_path = "public/storage/deposit_orders";
        // if the image was erased
        if ($value == null) {
            // delete the image from disk
            \Storage::disk($disk)->delete($this->{$attribute_name});

            // set null in the database column
            $this->attributes[$attribute_name] = null;
        }

        // if a base64 was sent, store it in the db
        if (Str::startsWith($value, 'data:image')) {
            // 0. Make the image
            $image = \Image::make($value)->encode('png', 90);

            // 1. Generate a filename.
            $filename = md5($value.time()).'.png';

            // 2. Store the image on disk.
            \Storage::disk($disk)->put($destination_path.'/'.$filename, $image->stream());

            // 3. Delete the previous image, if there was one.
            \Storage::disk($disk)->delete($this->{$attribute_name});

            // 4. Save the public path to the database
            // but first, remove "public/" from the path, since we're pointing to it
            // from the root folder; that way, what gets saved in the db
            // is the public URL (everything that comes after the domain name)
            $public_destination_path           = Str::replaceFirst('public/', '', $destination_path);
            $this->attributes[$attribute_name] = $public_destination_path.'/'.$filename;

            //@todo add this for save images for multi langs
            return $this->attributes['img_path'];
        }
    }
}