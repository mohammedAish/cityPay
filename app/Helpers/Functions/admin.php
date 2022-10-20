<?php


use App\Helpers\Ip;
use App\Helpers\UrlGen;
use App\Models\Country as CountryModel;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Stevebauman\Location\Facades\Location;


function default_tadawul_img() {
    return url('/storage/Agencies/8d6ab28cdd353e016e9b912b36e728aa.png');
}

function generateWalletCode() {
    $maxWalletCustomersCode = config('ytadawul.max_yt_wallet_codes');
    $maxCode                = \App\Models\Customer::
    where('wallet_code', '>', $maxWalletCustomersCode)
        ->max('wallet_code');
    $maxCode                = $maxCode > $maxWalletCustomersCode ? $maxCode : $maxWalletCustomersCode;
    ++$maxCode;

    return $maxCode;
}

function getCountryCodeFromIP() {
    // Localize the user's country
    try {
        if ($position = Location::get()) {
            // Successfully retrieved position.

            return $position->countryCode;

        } else {
            if ($position = Location::get(Ip::get())) {

                return $position->countryCode;
            }

            return false;
        }
    } catch (\Exception $e) {
        return false;
    }

}

function getCountryFromCookie() {
    if (isset($_COOKIE['ip_country_code'])) {
        $countryCode = $_COOKIE['ip_country_code'];
        if (trim($countryCode) == '') {
            return collect();
        } // TMP

        return getCountryInfo($countryCode);
    } else {
        return collect();
    }
}

function getCountryInfo($countryCode) {
    if (trim($countryCode) == '') {
        return collect();
    }
    $countryCode = strtoupper($countryCode);
    $country     = CountryModel::where('code', $countryCode)->first();

    if (empty($country)) {
        return collect();
    }

    return $country;
}

/**
 * @deprecated
 * @return CountryModel|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|\Illuminate\Support\Collection|object
 */
function getCountryFromIP() {
    $country = getCountryFromCookie();
    if (!$country->isEmpty()) {
        if ($country->get('level') == 'user') { // @todo: Check if user has logged
            $country = getCountryInfo($country->get('id'));
        }

        return $country;
    } else {
        // GeoIP
        $countryCode = getCountryCodeFromIP();
        if (!$countryCode || trim($countryCode) == '') {
            // Geolocalization has failed
            return collect();
        }

        return setCountryToCookie($countryCode);
    }
}

function setCountryToCookie($countryCode) {
    if (trim($countryCode) == '') {
        return collect();
    }

    if (isset($_COOKIE['ip_country_code'])) {
        unset($_COOKIE['ip_country_code']);
    }

    $domain = (getSubDomainName() != '') ? getSubDomainName().'.'.getDomain() : getDomain();
    setcookie('ip_country_code', $countryCode, 3600, '/', $domain);

    return getCountryInfo($countryCode);
}


function get_internal_withdraw_percent() {
    return config('ytadawul.internal_withdraw.fee_percent');
}


function convertToHoursMins($time, $format = '%02d:%02d') {
    if ($time < 1) {
        return 0;
    }
    $hours   = floor($time / 60);
    $minutes = ($time % 60);

    return sprintf($format, $hours, $minutes);
}


function getPriceFromDiscount($modelInfo) {


    if ($modelInfo->price <= 0) {
        return 0;
    }
    if (isset($modelInfo->discount_type) && in_array($modelInfo->discount_typ, ['percent', 'amount'])) {
        if ($modelInfo->discount_type == 'percent' && $modelInfo->discount_type) {
            if ($modelInfo->discoun > 1) {
                $modelInfo->discoun /= 100;
            }
            $price = $modelInfo->price - ($modelInfo->price * $modelInfo->discount);
        } else {
            $price = $modelInfo->price - $modelInfo->discount;
        }
    } else {
        $price = $modelInfo->price - $modelInfo->discount;
    }

    if ($modelInfo->currency_id != config('ytadawul.default_currency_id')) {
        $price = getEqualPriceInDollar($modelInfo->currency_id, $price);
    }

    return $price;
}

function getEqualPriceInDollar($currency_id, $amount) {
    $currencyValue = \App\Models\Currency::where('id', $currency_id)->first()
        ->exchange_price;

    return number_format($amount / $currencyValue, 2);
}

function calcExchangePriceFromDollar($amountInDollar, $currencyValue) {
    return number_format($amountInDollar * $currencyValue, 2);
}

function calcExchangePriceInDollar($amount, $currency_value) {
    return number_format($amount / $currency_value, 2);
}

/**
 * @param  string  $path
 *
 * @return string
 */
function current_local() {
    $local = LaravelLocalization::getCurrentLocale();

    return $local;/*
    $local = config('app.locale');
    return $local;*/
}

function current_direction() {
    $dir = config('backpack.base.html_direction', 'rtl');;

    return $dir;
}

function admin_uri($path = '') {
    $path = str_replace(url(config('backpack.base.route_prefix', 'admin')), '', $path);
    $path = ltrim($path, '/');

    if (!empty($path)) {
        $path = config('backpack.base.route_prefix', 'admin').'/'.$path;
    } else {
        $path = config('backpack.base.route_prefix', 'admin');
    }

    return $path;
}

/**
 * @param  string  $path
 *
 * @return string
 */
function admin_url($path = '') {
    return url(admin_uri($path));
}

/**
 * Default Admin translator (e.g. admin::messages.php)
 *
 * @param $string
 * @param  array  $params
 * @param  string  $file
 * @param  null  $locale
 *
 * @return string|\Symfony\Component\Translation\TranslatorInterface
 */
function __t($string, $params = [], $file = 'admin::messages', $locale = null) {
    if (is_null($locale)) {
        $locale = config('app.locale');
    }

    return trans($file.'.'.$string, $params, $locale);
}

/**
 * Checkbox Display
 *
 * @param $fieldValue
 *
 * @return string
 */
function checkboxDisplay($fieldValue) {
    // fa-square-o | fa-check-square-o
    // fa-toggle-off | fa-toggle-on
    if ($fieldValue == 1) {
        return '<i class="admin-single-icon fa fa-toggle-on" aria-hidden="true"></i>';
    } else {
        return '<i class="admin-single-icon fa fa-toggle-off" aria-hidden="true"></i>';
    }
}

/**
 * Ajax Checkbox Display
 *
 * @param $id
 * @param $table
 * @param $field
 * @param  null  $fieldValue
 *
 * @return string
 */

function ajaxCheckboxDisplay($id, $table, $field, $fieldValue = null) {
    $lineId = $field.$id;
    $lineId = str_replace('.', '', $lineId); // fix JS bug (in admin layout)
    $data   = 'data-table="'.$table.'" 
			data-field="'.$field.'" 
			data-line-id="'.$lineId.'" 
			data-id="'.$id.'" 
			data-value="'.(isset($fieldValue) ? $fieldValue : 0).'"';


    // Decoration
    if (isset($fieldValue) && $fieldValue == 1) {
        $html = '<i id="'.$lineId.'" class="admin-single-icon fa fa-toggle-on" aria-hidden="true"></i>';
    } else {
        $html = '<i id="'.$lineId.'" class="admin-single-icon fa fa-toggle-off" aria-hidden="true"></i>';
    }
    $html = '<a href="" class="ajax-request" '.$data.'>'.$html.'</a>';

    return $html;
}

/**
 * Advanced Ajax Checkbox Display
 *
 * @param $id
 * @param $table
 * @param $field
 * @param  null  $fieldValue
 *
 * @return string
 */
function installAjaxCheckboxDisplay($id, $table, $field, $fieldValue = null) {
    $lineId = $field.$id;
    $lineId = str_replace('.', '', $lineId); // fix JS bug (in admin layout)
    $data   = 'data-table="'.$table.'" 
			data-field="'.$field.'" 
			data-line-id="'.$lineId.'" 
			data-id="'.$id.'" 
			data-value="'.$fieldValue.'"';

    // Decoration
    if ($fieldValue == 1) {
        $html = '<i id="'.$lineId.'" class="admin-single-icon fa fa-toggle-on" aria-hidden="true"></i>';
    } else {
        $html = '<i id="'.$lineId.'" class="admin-single-icon fa fa-toggle-off" aria-hidden="true"></i>';
    }
    $html = '<a href="" class="ajax-request" '.$data.'>'.$html.'</a>';

    // Install country's decoration
    $html .= ' &nbsp;';
    if ($fieldValue == 1) {
        $html .= '<a href="" id="install'.$id.'" class="ajax-request btn btn-xs btn-success" '.$data.'>';
        $html .= '<i class="fa fa-download"></i> '.trans('admin::messages.Installed');
        $html .= '</a>';
    } else {
        $html .= '<a href="" id="install'.$id.'" class="ajax-request btn btn-xs btn-default" '.$data.'>';
        $html .= '<i class="fa fa-download"></i> '.trans('admin::messages.Install');
        $html .= '</a>';
    }

    return $html;
}

/**
 * Generate the Post's link from the Admin panel
 *
 * @param $post
 *
 * @return string
 */
function getPostUrl($post) {
    $out = '';

    if (isset($post->latestPayment) && !empty($post->latestPayment)) {
        if (isset($post->latestPayment->package) && !empty($post->latestPayment->package)) {
            $info = '';
            if ($post->featured == 1) {
                $class = 'text-success';
            } else {
                $class = 'text-danger';
                $info  = ' ('.trans('admin::messages.Expired').')';
            }
            $out = ' <i class="fa fa-check-circle '.$class.' tooltipHere"
                    title="" data-placement="bottom" data-toggle="tooltip"
                    type="button" data-original-title="'.$post->latestPayment->package->short_name.$info.'">
                </i>';
        }
    }

    // Get URL
    $url = localUrl($post->country_code, UrlGen::postPath($post));
    $out = '<a href="'.$url.'" target="_blank">'.\Illuminate\Support\Str::limit($post->title, 60).'</a>'.$out;

    return $out;
}

/**
 * @param $entry
 * @param  bool  $withLink
 *
 * @return string
 */
function getCountryFlag($entry, $withLink = false) {
    $out = '';

    if (isset($entry->country_code)) {
        $countryName = (isset($entry->country) && isset($entry->country->asciiname)) ? $entry->country->asciiname : null;
        $countryName = (empty($countryName) && isset($entry->country) && isset($entry->country->name)) ? $entry->country->name : $countryName;
        $countryName = (!empty($countryName)) ? $countryName : $entry->country_code;

        $iconPath = 'images/flags/16/'.strtolower($entry->country_code).'.png';
        if (file_exists(public_path($iconPath))) {
            $out = '';
            $out .= ($withLink) ? '<a href="'.localUrl($entry->country_code, '', true).'" target="_blank">' : '';
            $out .= '<img src="'.url($iconPath).getPictureVersion().'" data-toggle="tooltip" title="'.$countryName.'">';
            $out .= ($withLink) ? '</a>' : '';
            $out .= ' ';
        } else {
            $out .= $entry->country_code.' ';
        }
    }

    return $out;
}

/**
 * Check if the Post is verified
 *
 * @param $post
 *
 * @return bool
 */
function isVerifiedPost($post) {
    if (!isset($post->verified_email) || !isset($post->verified_phone) || !isset($post->reviewed)) {
        return false;
    }

    if (config('settings.single.posts_review_activation')) {
        $verified = ($post->verified_email == 1 && $post->verified_phone == 1 && $post->reviewed == 1) ? true : false;
    } else {
        $verified = ($post->verified_email == 1 && $post->verified_phone == 1) ? true : false;
    }

    return $verified;
}

/**
 * Check if the User is verified
 *
 * @param $user
 *
 * @return bool
 */
function isVerifiedUser($user) {
    if (!isset($user->verified_email) || !isset($user->verified_phone)) {
        return false;
    }

    return ($user->verified_email == 1 && $user->verified_phone == 1) ? true : false;
}

/**
 * @return bool
 */
function userHasSuperAdminPermissions() {
    if (auth()->check()) {
        $permissions = \App\Models\Permission::getSuperAdminPermissions();

        // Remove the standard admin permission
        $permissions = collect($permissions)->reject(function ($value, $key) {
            return $value == 'access-dashboard';
        })->toArray();

        // Check if user has the super admin permissions
        if (auth()->user()->can($permissions)) {
            return true;
        }
    }

    return false;
}
