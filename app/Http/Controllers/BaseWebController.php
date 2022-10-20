<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CommonTrait;
use App\Http\Controllers\Traits\WalletTrait;
use App\Models\FrontEnd;
use App\Models\Language;
use App\Models\OrgModels\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class BaseWebController extends Controller
{
    public $settings;
    public $current_local;
    public $current_direction;
    public $current_var;
    use CommonTrait, WalletTrait;

    public function __construct($service_id = null) {
        if (!$this->settings) {
            $this->settings = SiteSetting::all();
        }
        auth()->setDefaultDriver('customers');

        //any controller that extend this controller
        // and need instruction must send number service in constructor
        if (!empty($service_id)) {
            view()->share('instructions', $this->getServiceInstructions($service_id));
        }

    }


    public function changeLanguage(Request $request) {
        if ($request->ajax()) {
            $language = $this->getLanguage($request->languages_id);
            $request->session()->put('locale', $language->abbr);
            $request->session()->put('direction', $language->direction);
            Session::put('locale', $language->abbr);
            Session::put('direction', $language->direction);
            Session::put('lang', $language->abbr);
            $locale = $language->abbr;
            app('config')->set('backpack.base.html_direction', $language->direction);
            App::setLocale($locale);
            if (request()->segment(1) == 'change_admin_language') {
                echo $this->getNewHost('admin');
            } else {
                echo $this->getNewHost($locale);
            }
        }
    }

    public function changeLang($abbr, Request $request) {
        $current_lang = session()->get('locale');
        $language = $this->getLanguage($abbr);
        $request->session()->put('locale', $language->abbr);
        $request->session()->put('direction', $language->direction);
        Session::put('locale', $language->abbr);
        Session::put('direction', $language->direction);
        Session::put('lang', $language->abbr);
        $locale = $language->abbr;
        app('config')->set('backpack.base.html_direction', $language->direction);
        App::setLocale($locale);
        $url = str_replace($current_lang, $locale, url()->previous());
//        dd(str_replace($current_lang, $locale, url()->previous()));
        return Redirect::to(str_replace('dashboend', 'dashboard', $url));
    }

    function getNewHost($new_local = '') {
        $parsed_url = parse_url(url()->previous());
        $parsed     = isset($parsed_url['path']) ? $parsed_url['host'].$parsed_url['path'] : $parsed_url['host'];
        $parsed     = isset($parsed_url['query']) ? $parsed.'?'.$parsed_url['query'] : $parsed;
        $params     = explode('/', $parsed);
        $params[1]  = $new_local;
        array_unshift($params, $parsed_url['scheme'].':/');
        $redirection = implode('/', $params);
        return $redirection;
    }

    function getLanguage($abbr) {
        return Language::where('abbr', $abbr)->first();
    }
}
