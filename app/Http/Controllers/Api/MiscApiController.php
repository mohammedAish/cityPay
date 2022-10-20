<?php


namespace App\Http\Controllers\Api;


use App\Http\Resources\CountryResource;
use App\Http\Resources\LanguageResource;
use App\Models\Country;
use App\Models\Language;

class MiscApiController extends BaseApiController
{

    public function getCountries(){
        $countries = Country::whereActive(1)->get();
        return $this->success_response(CountryResource::collection($countries),'you_get_all_countries');
    }

    public function getLanguages(){
        $languages = Language::whereActive(1)->get();

        return $this->success_response(LanguageResource::collection($languages),'you_get_all_languages');
    }

}
