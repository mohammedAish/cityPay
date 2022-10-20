<?php

namespace App\Providers;

use App\Models\FrontEnd;
use App\Models\OrgModels\SiteSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        Schema::defaultStringLength(191);
        Schema::enableForeignKeyConstraints();

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        //   View::share('header', SiteSetting::all()->first());

        //@todo create user controller and bind it with backpack user controller
        //@TODO  s
        /*$this->app->bind(
            \Backpack\PermissionManager\app\Http\Controllers\UserCrudController::class, //this is package controller
            \App\Http\Controllers\Admin\UserCrudController::class //this should be your own controller
        );*/
        $viewShare['general'] = SiteSetting::first();
        view()->share($viewShare);
        $frontEnd                    = FrontEnd::where('lang_code', app()->getLocale())->get();
        $viewShare['socials']        = $frontEnd->filter(function ($item) {
            return $item->data_keys == 'social';
        })->all();
        $viewShare['shortAbout']     = $frontEnd->filter(function ($item) {
            return $item->data_keys == 'homecontent';
        })->first();
        $viewShare['menus']          = collect($frontEnd->filter(function ($item) {
            return $item->data_keys == 'menu';
        })->all());
        $viewShare['company_policy'] = collect($frontEnd->filter(function ($item) {
            return $item->data_keys == 'company_policy';
        })->all());


        $viewShare['curr_local']     = app()->getLocale();
        view()->share($viewShare);

    }
}
