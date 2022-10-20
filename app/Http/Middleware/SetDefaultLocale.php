<?php


namespace App\Http\Middleware;

use App\Models\Language;
use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;

class SetDefaultLocale
{
	protected static $cacheExpiration = 3600;

	/**
	 * Handle an incoming request.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param \Closure $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		/*if (isFromAdminPanel()) {
			//$this->setTranslationOfCurrentCountry();
			return $next($request);
		}*/


		// Apply Session Language Code to the system
		if (session()->has('langCode')) {
			$langCode = session()->get('langCode');
			$lang = Cache::remember('language.' . $langCode, self::$cacheExpiration, function () use ($langCode) {
				$lang = Language::where('abbr', $langCode)->first();
				return $lang;
			});

			if (!empty($lang)) {
				// Config: Language (Updated)
				config()->set('lang.abbr', $lang->abbr);
				config()->set('lang.locale', $lang->locale);
				config()->set('lang.direction', $lang->direction);
				config()->set('lang.date_format', $lang->date_format ?? null);
				config()->set('lang.datetime_format', $lang->datetime_format ?? null);
				// Apply Country's Language Code to the system
				config()->set('app.locale', $langCode);
			}
		}
        App::setLocale($langCode);
		//$this->setTranslationOfCurrentCountry();

		return $next($request);
	}

	/**
	 * Set the translation of the current Country
	 */
	private function setTranslationOfCurrentCountry()
	{
		/*if (config()->has('country.name')) {
			$countryName = getColumnTranslation(config('country.name'));
			config()->set('country.name', $countryName);
		}*/
	}
}
