<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix'     => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect','localizationRedirect','auth:customers'],
    'namespace'  => 'Web',
],

    function (){

        Route::get('/consulting/main','ConsultingController@mainContent')->name('consultants.main');
        Route::get('/consulting/category/{cat_id?}',
            'ConsultingController@consultantsCategory')->name('consultants.category');
        Route::get('/consulting/detail/{cat_id?}','ConsultingController@consultantInfo')->name('consultant.detail');
        Route::post('/consulting/checkout','CustomerOrderController@consultantOrder')->name('consultant.buy');
        Route::get('/consulting/consultant/checkout/{consultant_id?}',
            'ConsultingController@consultantCheckout')->name('consultant.checkout');

        //Auth Routes
        Route::group([

            'prefix'     => 'consultants',
            'namespace'  => 'Consultants',
            'middleware' => ['auth:customers'],
        ],function (){
            Route::group([
            ],function (){
                Route::get('my-consultings','CustomerConsultantController@listMyConsultants')->name('my_cons');
                Route::get('my-consultants','CustomerConsultantController@listMyConsultants')->name('profile.my_cons');

            });
        });
    });


