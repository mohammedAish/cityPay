<?php

namespace App\Models\OrgModels;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Activitylog\Traits\LogsActivity;

class PageSetup extends Model
{
    use LogsActivity,CrudTrait;
    protected $table = 'org_page_setups';
    protected $guarded = [];
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    /*
     * `about_company_title`, `about_company_background`, `about_company_sub_title`,
     * `about_company_keyword`, `news_title`, `news_background`, `news_sub_title`, `news_keyword`,
     *  `services_title`, `services_background`, `services_sub_title`, `services_keyword`, `offers_title`,
     * `offers_background`, `offers_sub_title`, `offers_keyword`, `blog_title`, `blog_background`, `blog_sub_title`,
     *  `blog_keyword`, `about_company_title_en`, `about_company_sub_title_en`, `about_company_keyword_en`,
     *  `news_title_en`, `news_sub_title_en`, `news_keyword_en`, `services_title_en`, `services_sub_title_en`,
     *  `services_keyword_en`, `offers_title_en`, `offers_sub_title_en`,
     *  `offers_keyword_en`, `blog_title_en`, `blog_sub_title_en`, `blog_keyword_en`
     */
    //@todo Eman complete it for all attributes that have eng and ar same as AboutCompanyPageSetting Model

}
