<?php

namespace App\Models\OrgModels;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class SiteSetting extends Model
{
    use CrudTrait,LogsActivity;
    protected $table = "org_settings";
    public $appends = [
        'website_title','website_description','home_keywords','who_us','mission','vision','copy_right',
    ];

    function getWebsiteTitleAttribute(){
        if ('en' == config('app.locale')) {
            return $this->attributes['website_title_en'];
        }

        return $this->attributes['website_title'];
    }

    function getWebsiteDescriptionAttribute(){
        if ('en' == config('app.locale')) {
            return $this->attributes['website_description_en'];
        }

        return $this->attributes['website_description'];
    }

    function getHomeKeywordsAttribute(){
        if ('en' == config('app.locale')) {
            return $this->attributes['home_keywords_en'];
        }

        return $this->attributes['home_keywords'];
    }

    function getWhoUsAttribute(){
        if ('en' == config('app.locale')) {
            return $this->attributes['who_us_en'];
        }

        return $this->attributes['who_us'];
    }

    function getMissionAttribute(){
        if ('en' == config('app.locale')) {
            return $this->attributes['mission_en'];
        }

        return $this->attributes['mission'];
    }

    function getVisionAttribute(){
        if ('en' == config('app.locale')) {
            return $this->attributes['vision_en'];
        }

        return $this->attributes['vision'];
    }

    function getCopyRightAttribute(){
        if ('en' == config('app.locale')) {
            return $this->attributes['copy_right_en'];
        }

        return $this->attributes['copy_right'];
    }
}
