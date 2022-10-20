<?php

namespace App\Models\OrgModels;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class AboutCompanyPageSetting extends Model
{
    use LogsActivity,CrudTrait;
    protected $table = 'org_about_company_page_settings';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    public $appends = ['trade_mark_desc','trade_mark_title','Definition_company_title','Definition_company_desc'];



    function getDefinitionCompanyTitleAttribute(){
        if ('en' == config('app.locale')) {
            return $this->attributes['Definition_company_title_en'];
        }
        return $this->attributes['Definition_company_title'];
    }

    function getDefinitionCompanyDescAttribute(){
        if ('en' == config('app.locale')) {
            return $this->attributes['Definition_company_desc_en'];
        }

        return $this->attributes['Definition_company_desc'];
    }

    function getTradeMarkDescAttribute(){
        if ('en' == config('app.locale')) {
            return $this->attributes['trade_mark_desc_en'];
        }

        return $this->attributes['trade_mark_desc'];
    }

    function getTradeMarkTitleAttribute(){
        if ('en' == config('app.locale')) {
            return $this->attributes['trade_mark_title_en'];
        }

        return $this->attributes['trade_mark_title'];
    }

}
