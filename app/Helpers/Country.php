<?php


namespace App\Helpers;

use App\Helpers\ArrayHelper;
use App\Helpers\Ip;

use App\Helpers\UrlGen;

/*use App\Models\City;
use App\Models\Permission;
use App\Models\Post;
use App\Models\Currency;
use App\Models\Language as LanguageModel;
use App\Models\Scopes\ReviewedScope;
use App\Models\Scopes\VerifiedScope;*/

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use App\Models\Country as CountryModel;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

use Stevebauman\Location\Facades\Location;

class Country
{
    public $configRepository;
    public $view;
    public $translator;
    public $router;
    public $request;
    public $language;

    public $defaultCountryCode = '';
    public $defaultUrl = '/';
    public $defaultPage = '/';

    public $countries;
    public $country;
    public $ipCountry;
    public $siteCountryInfo = '';
    public $paddingTopExists = false;

    public static $cacheExpiration = 3600;
    public static $cookieExpiration = 3600;

    // Maxmind Support URL
    private static $maxmindSupportUrl = 'http://support.bedigit.com/help-center/articles/14/enable-the-geo-location';


    public function __construct() {
        $this->app = app();

        $this->configRepository = $this->app['config'];
        $this->view             = $this->app['view'];
        $this->translator       = $this->app['translator'];
        $this->router           = $this->app['router'];
        $this->request          = $this->app['request'];


        // Default values
        $this->defaultCountryCode = config('settings.geo_location.default_country_code', 'ye');

        // Cache & Cookies Expiration Time
        self::$cacheExpiration  = config('settings.optimization.cache_expiration', self::$cacheExpiration);
        self::$cookieExpiration = config('settings.other.cookie_expiration', 3500);

        // Init. Country Infos
        $this->country   = collect();
        $this->ipCountry = collect();
    }

    /**
     * @return bool|mixed|\stdClass
     */
    public function find() {
        try {


            // Get User Country by its IP address
            $this->ipCountry = $this->getCountryFromIP();
            $this->country   = $this->ipCountry;
            // Get the Country
            if (isFromApi()) {
                // API call
                // Get Country from logged User
                $this->country = $this->getCountryFromUser();

                // If Country didn't find,
                // Get the Default Country.
                if ($this->country->isEmpty()) {
                    $this->country = $this->getDefaultCountry($this->defaultCountryCode);
                }
                // If Country didn't find,
                // Set the Country related to the User's IP address as Default Country.
                if ($this->country->isEmpty()) {
                    if (!$this->ipCountry->isEmpty() && $this->ipCountry->has('code')) {
                        $this->country = $this->ipCountry;
                    }
                }

                // If Country didn't find & If it's a call from the API Plugin,
                // Get the Most Populated Country as Default Country.
                // NOTE: This prevent any HTTP redirection
                if ($this->country->isEmpty()) {
                    $this->country = $this->getMostPopulatedCountry();
                }

            } else {
                // WEB call


                // If Country didn't find,
                // Set the Country related to the User's IP address as Default Country.
                if ($this->country->isEmpty()) {
                    if (!$this->ipCountry->isEmpty() && $this->ipCountry->has('code')) {
                        $this->country = $this->ipCountry;
                    }
                }
                // If Country didn't find & If Administrator has been set a Default Country,
                // Get the Default Country.
                if ($this->country->isEmpty()) {
                    $this->country = $this->getDefaultCountry($this->defaultCountryCode);
                }
            }
        } catch (\Exception $ex) {
            $this->country = $this->getDefaultCountry($this->defaultCountryCode);
        }

        return $this->country;
    }

    /**
     * @return bool
     */
    public function setCountryParameters() {
        // SKIP...
        // - Countries Selection Page
        // - All XML Sitemap Pages
        // - robots.txt
        // - Feed Page
        if (
            in_array(request()->segment(1), [
                config('larapen.localization.countries_list_uri'),
                'robots',
                'robots.txt',
                'feed',
            ]) ||
            Str::endsWith($this->request->url(), '.xml')
        ) {
            return false;
        }


        // REDIRECT... If Country not found, then redirect to country selection page
        if (!$this->isAvailableCountry($this->country->get('code'))) {
            redirectUrl($this->defaultPage, 301, config('larapen.core.noCacheHeaders'));
        }

        // TIPS NOTIFICATION MESSAGES
        if (config('settings.other.show_tips_messages')) {
            // SHOW MESSAGE... (About Login) If user not logged
            if (!auth()->check() && !in_array(request()->segment(1), [
                    'login',
                    'register',
                    'posts',
                    'page',
                    'contact',
                    'sitemap',
                    'verify',
                ]) &&
                !request()->filled('iam') &&
                request()->segment(1) !== null &&
                !Str::contains(Route::currentRouteAction(), 'Search\\') &&
                !Str::contains(Route::currentRouteAction(), 'SitemapController') &&
                !Str::contains(Route::currentRouteAction(), 'PasswordController')
            ) {
                $msg                    = 'login_for_faster_access_to_the_best_deals';
                $this->siteCountryInfo  = t($msg, [
                    'login_url'    => UrlGen::login(),
                    'register_url' => UrlGen::register(),
                ], 'global', config('app.locale'));
                $this->paddingTopExists = true;
            }

            // SHOW MESSAGE... (About Location)
            // - If we know the user IP country
            // - and if user visiting another country's website
            // - and if Geolocation is activated
            if (config('settings.geo_location.geolocation_activation')) {
                if (!$this->ipCountry->isEmpty() && !$this->country->isEmpty()) {
                    if ($this->ipCountry->get('code') != $this->country->get('code')) {
                        $msg                    = 'app_is_also_available_in_your_country';
                        $this->siteCountryInfo  = t($msg, [
                            'appName' => config('settings.app.app_name'),
                            'country' => getColumnTranslation($this->ipCountry->get('name')),
                            'url'     => dmUrl($this->ipCountry, '/', true, true),
                        ]);
                        $this->paddingTopExists = true;
                    }
                }
            }
        }

        // Share vars to views
        if (isset($this->siteCountryInfo) && $this->siteCountryInfo != '') {
            view()->share('siteCountryInfo', $this->siteCountryInfo);
        }
        if (isset($this->paddingTopExists)) {
            view()->share('paddingTopExists', $this->paddingTopExists);
        }

        return true;
    }

    /**
     * Get the Most Populated Country (for API)
     * NOTE: Prevent Country Selection's Page redirection.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getMostPopulatedCountry() {
        try {
            $country = CountryModel::orderBy('population', 'DESC')->firstOrFail();
            if (!empty($country)) {
                if ($this->isAvailableCountry($country->code)) {
                    return self::getCountryInfo($country->code);
                }
            }
        } catch (\Exception $e) {
        }

        return collect();
    }

    /**
     * Get the Default Country
     *
     * @param $defaultCountryCode
     * @return \Illuminate\Support\Collection
     */
    public function getDefaultCountry($defaultCountryCode) {

        return self::getCountryInfo('ye');

    }

    /**
     * Get Country from Session
     *
     * @return \Illuminate\Support\Collection
     */
    public function getCountryFromSession() {
        if (!isFromApi()) { // Session is never started from API Middleware
            if (session()->has('country_code')) {
                if ($this->isAvailableCountry(session('country_code'))) {
                    return self::getCountryInfo(session('country_code'));
                }
            }
        }

        return collect();
    }

    /**
     * Get Country from logged User (for API)
     *
     * @return \Illuminate\Support\Collection
     */
    public function getCountryFromUser() {
        if (auth()->check()) {
            if (isset(auth()->user()->country_code)) {
                if ($this->isAvailableCountry(auth()->user()->country_code)) {
                    return self::getCountryInfo(auth()->user()->country_code);
                }
            }
        }

        return collect();
    }

    /**
     * Get Country from logged User
     *
     * @return \Illuminate\Support\Collection
     */
    public function getCountryFromPost() {
        $country = collect();

        // Check if the Post Details controller is called
        if (Str::contains(Route::currentRouteAction(), 'Post\DetailsController')) {
            // Get and Check the Controller's Method Parameters
            $parameters = request()->route()->parameters();

            // Return empty collection if the Post ID not found
            if (!isset($parameters['id']) || empty($parameters['id'])) {
                return collect();
            }

            // Get the Post
            $post = Post::withoutGlobalScopes([VerifiedScope::class, ReviewedScope::class])->where('id',
                $parameters['id'])->first();
            if (empty($post)) {
                return collect();
            }

            // Get the Post's Country Info (If available)
            if ($this->isAvailableCountry($post->country_code)) {
                $country = self::getCountryInfo($post->country_code);
            }
        }

        return $country;
    }

    /**
     * Get Country from Domain
     *
     * @return \Illuminate\Support\Collection
     */
    public function getCountryFromDomain() {
        $host = getHost(url()->current());

        $domain = collect((array) config('domains'))->firstWhere('host', $host);
        if (!empty($domain) && isset($domain['country_code']) && !empty($domain['country_code'])) {
            $countryCode = $domain['country_code'];
            if ($this->isAvailableCountry($countryCode)) {
                return self::getCountryInfo($countryCode);
            }
        }

        return collect();
    }

    /**
     * Get Country from Sub-Domain
     *
     * @return \Illuminate\Support\Collection
     */
    public function getCountryFromSubDomain() {
        $countryCode = getSubDomainName();
        if ($this->isAvailableCountry($countryCode)) {
            return self::getCountryInfo($countryCode);
        }

        return collect();
    }

    /**
     * Get Country from Query String
     *
     * @return \Illuminate\Support\Collection
     */
    public function getCountryFromQueryString() {
        $countryCode = '';
        if (request()->filled('site')) {
            $countryCode = request()->get('site');
        }
        if (request()->filled('d')) {
            $countryCode = request()->get('d');
        }

        if ($this->isAvailableCountry($countryCode)) {
            return self::getCountryInfo($countryCode);
        }

        return collect();
    }

    /**
     * Get Country from URI Path
     *
     * @return \Illuminate\Support\Collection
     */
    public function getCountryFromURIPath() {
        $country = collect();

        $countryCode = getCountryCodeFromPath();
        if (!empty($countryCode)) {
            if ($this->isAvailableCountry($countryCode)) {
                $country = self::getCountryInfo($countryCode);
            }
        }

        return $country;
    }

    /**
     * Get Country from City
     *
     * @return \Illuminate\Support\Collection
     */
    public function getCountryFromCity() {
        $countryCode = null;
        $cityId      = null;

        if (Str::contains(Route::currentRouteAction(), 'Search\CityController')) {
            if (!config('settings.seo.multi_countries_urls')) {
                $cityId = request()->segment(3);
            } else {
                $cityId = request()->segment(4);
            }
        }
        if (Str::contains(Route::currentRouteAction(), 'Search\SearchController')) {
            if (request()->filled('l')) {
                $cityId = request()->get('l');
            }
        }

        if (!empty($cityId)) {
            $city = Cache::remember('city.'.$cityId, self::$cacheExpiration, function () use ($cityId) {
                return City::find($cityId);
            });
            if (!empty($city)) {
                $countryCode = $city->country_code;
                if ($this->isAvailableCountry($countryCode)) {
                    return self::getCountryInfo($countryCode);
                }
            }
        }

        return collect();
    }

    /**
     * Get Country for Bots if not found
     *
     * @return \Illuminate\Support\Collection
     */
    public function getCountryForBots() {
        $crawler = new CrawlerDetect();
        if ($crawler->isCrawler()) {
            // Don't set the default country for homepage
            if (!Str::contains(Route::currentRouteAction(), 'HomeController')) {
                $countryCode = config('settings.geo_location.default_country_code');
                if ($this->isAvailableCountry($countryCode)) {
                    return self::getCountryInfo($countryCode);
                }
            }
        }

        return collect();
    }

    /**
     * @return bool|\Illuminate\Support\Collection|mixed|\stdClass
     */
    public function getCountryFromIP() {
        $country = self::getCountryFromCookie();
        if (!$country->isEmpty()) {
            if ($country->get('level') == 'user') { // @todo: Check if user has logged
                $country = self::getCountryInfo($country->get('code'));
            }

            return $country;
        } else {
            // GeoIP
            $countryCode = $this->getCountryCodeFromIP();
            if (!$countryCode || trim($countryCode) == '') {
                // Geolocalization has failed
                return collect();
            }

            return self::setCountryToCookie($countryCode);
        }
    }

    /**
     * @param $countryCode
     * @return bool|\Illuminate\Support\Collection|\stdClass
     */
    public static function setCountryToCookie($countryCode) {
        if (trim($countryCode) == '') {
            return collect();
        }

        if (isset($_COOKIE['ip_country_code'])) {
            unset($_COOKIE['ip_country_code']);
        }

        $domain = (getSubDomainName() != '') ? getSubDomainName().'.'.getDomain() : getDomain();
        setcookie('ip_country_code', $countryCode, self::$cookieExpiration, '/', $domain);

        return self::getCountryInfo($countryCode);
    }

    /**
     * @return bool|mixed
     */
    public static function getCountryFromCookie() {
        if (isset($_COOKIE['ip_country_code'])) {
            $countryCode = $_COOKIE['ip_country_code'];
            if (trim($countryCode) == '') {
                return collect();
            } // TMP

            return self::getCountryInfo($countryCode);
        } else {
            return collect();
        }
    }

    /**
     * @return bool|string
     */
    public static function getCountryCodeFromIP() {
        // Localize the user's country
        try {
            if ($position = Location::get()) {
                // Successfully retrieved position.

                return $position->countryCode;

            } else {
                if ($position = Location::get(Ip::get())) {
                    // Successfully retrieved position.

                    return $position->countryCode;
                }

                return false;
            }
        } catch (\Exception $e) {
            return false;
        }

    }

    /**
     * @param $countryCode
     * @return \Illuminate\Support\Collection
     */
    public static function getCountryInfo($countryCode) {
        if (trim($countryCode) == '') {
            return collect();
        }
        $countryCode = strtoupper($countryCode);
        $country = Cache::remember('country.'.$countryCode, self::$cacheExpiration, function () use ($countryCode) {
            return CountryModel::where('code', $countryCode)->first();
        });
        if (empty($country)) {
            return collect();
        }
        return $country;
    }

    /**
     * Only used for search bots
     *
     * @param $languages
     * @return mixed
     */
    public static function getLangFromCountry($languages) {
        // Get language code
        $langCode = $hrefLang = '';
        if (trim($languages) != '') {
            // Get the country's languages codes
            $countryLanguageCodes = explode(',', $languages);

            // Get all languages
            $availableLanguages = Cache::remember('languages.all', self::$cacheExpiration, function () {
                return LanguageModel::all();
            });

            if ($availableLanguages->count() > 0) {
                $found = false;
                foreach ($countryLanguageCodes as $isoLang) {
                    foreach ($availableLanguages as $language) {
                        if (Str::startsWith(strtolower($isoLang), strtolower($language->abbr))) {
                            $langCode = $language->abbr;
                            $hrefLang = $isoLang;
                            $found    = true;
                            break;
                        }
                    }
                    if ($found) {
                        break;
                    }
                }
            }
        }

        // Get language info
        if ($langCode != '') {
            $isAvailableLang = Cache::remember('language.'.$langCode, self::$cacheExpiration,
                function () use ($langCode) {
                    return LanguageModel::where('abbr', $langCode)->first();
                });

            if (!empty($isAvailableLang)) {
                $lang = collect($isAvailableLang)->merge(collect(['hreflang' => $hrefLang]));
            } else {
                $lang = self::getLangFromConfig();
            }
        } else {
            $lang = self::getLangFromConfig();
        }

        return $lang;
    }

    /**
     * @return mixed
     */
    public static function getLangFromConfig() {
        $langCode = config('appLang.abbr');

        // Default language (from Admin panel OR Config)
        $lang = Cache::remember('language.'.$langCode, self::$cacheExpiration, function () use ($langCode) {
            return LanguageModel::where('abbr', $langCode)->first();
        });

        $lang = collect($lang)->merge(collect(['hreflang' => config('appLang.abbr')]));

        return $lang;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public static function getCountries() {
        // Get Countries from DB
        try {
            $countries = Cache::remember('countries.with.continent.currency', self::$cacheExpiration, function () {
                $countries = CountryModel::active()->orderBy('name')->get();

                if ($countries->count() > 0) {
                    $countries = $countries->keyBy('id');
                }

                return $countries;
            });
        } catch (\Exception $e) {
            // return collect();
            // To prevent HTTP 500 Error when site is not installed.
            return collect(['ye' => collect(['code' => 'ye', 'name' => 'yemen'])]);
        }

        // Country filters
        $tab = [];
        if ($countries->count() > 0) {
            foreach ($countries as $code => $country) {
                $countryArray         = $country->toArray();
                $countryArray['name'] = $country->name;

                // Get only Countries with currency
                if (isset($country->currency) && !empty($country->currency)) {
                    $tab[$code] = collect($countryArray)->forget('currency_code');
                } else {
                    // Just for debug
                    // dd(collect($item));
                }

                // Get only allowed Countries with active Continent
                if (!isset($country->continent) || $country->continent->active != 1) {
                    unset($tab[$code]);
                }
            }
        }
        $countries = collect($tab);

        // Sort
        $countries = ArrayHelper::mbSortBy($countries, 'name', app()->getLocale());

        return $countries;
    }

    /**
     * @param $countryCode
     * @return bool
     */
    public function isAvailableCountry($countryCode) {
        $countries             = self::getCountries();
        $availableCountryCodes = is_array($countries) ? collect(array_keys($countries)) : $countries->keys();
        $availableCountryCodes = $availableCountryCodes->map(function ($item, $key) {
            return strtolower($item);
        })->flip();
        if ($availableCountryCodes->has(strtolower($countryCode))) {
            return true;
        } else {
            return false;
        }
    }
}
