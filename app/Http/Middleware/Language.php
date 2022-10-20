<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Session;
use Config;
//use App;
use DB;

class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     *
     * @return mixed
     */
    public function handle($request,Closure $next){
        if (isFromAdminPanel()) {

            if (Session::has('locale')) {
                $locale = Session::get('locale',Config::get('app.locale'));

            } else {
                $languages = DB::table('languages')->where('default','=','1')->get();
                $request->session()->put('locale',$languages[0]->abbr);
                $request->session()->put('direction',$languages[0]->direction);
                $locale = $languages[0]->abbr;
                config()->set('backpack.base.html_direction',$languages[0]->direction);
                $direction = $languages[0]->direction;
            }

            App::setLocale($locale);
            $direction=($locale=='ar' ||$locale=='AR')
                ?'rtl':
                (($locale=='en'||$locale=='EN')?'ltr':Config::get('backpack.base.html_direction'));
            app('config')->set('backpack.base.html_direction',$direction);
        }

        return $next($request);
    }
}
