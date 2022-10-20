<?php

use Illuminate\Support\Facades\Route;

//artisan routes
Route::get('/clear', 'ArtisanCommandsController@clearCache');
Route::get('/copy', 'ArtisanCommandsController@copy');
Route::get('/optimize', 'ArtisanCommandsController@optimizeCache');
Route::get('/optimize_clear', 'ArtisanCommandsController@optimizeClear');
Route::get('/rout_cache', 'ArtisanCommandsController@routeCache');
Route::get('/rout_clear', 'ArtisanCommandsController@routeClear');
Route::get('/clear_compiled', 'ArtisanCommandsController@clearCompiled');
Route::get('/storage_lnk', 'ArtisanCommandsController@storageLnk');
Route::get('/envis', 'ArtisanCommandsController@envIs');
Route::get('/tlscop_pub', 'ArtisanCommandsController@telspub');
Route::get('/tls_clear', 'ArtisanCommandsController@telsclear');
Route::get('/migrate', 'ArtisanCommandsController@migrateDB');


//This is the URL where user will be redirected after a successful payment.
Route::get('/perfectmoney-success-callback', 'Web\PaymentController@perfectmoneySuccessCallback');
//This is the URL where user will be redirected after an unsuccessful payment attempt.
Route::get('/perfectmoney-nopayment-callback', 'Web\PaymentController@perfectmoneyFailCallback');

Route::get('/payeer-success-callback', 'Web\PaymentController@payeerSuccessCallback');
Route::get('/payeer-fail-callback', 'Web\PaymentController@payeerFailCallback');
Route::get('/payeer-status', 'Web\PaymentController@payeerStatus');

//new home routes
Route::group(
    [
        'prefix'     => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect'],
    ],
    function () {
        //Login Routes
        Route::get('/info/{id}/{slug?}', 'NewHomeController@policyInfo')->name('policy');
        Route::get('/', 'NewHomeController@index')->name('index');
        Route::get('/privacy', 'NewHomeController@privacy')->name('privacy');
        Route::get('/agreement', 'NewHomeController@agreement')->name('agreement');
        Route::get('/licenses', 'NewHomeController@licenses')->name('licenses');
    });

//auth routes
Auth::routes(['verify' => true]);


Route::group(
    [
        'prefix'     => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect'],
        'namespace'  => 'Auth',
    ],
    function () {
        //Login Routes
        Route::get('/login', 'LoginController@showLoginForm')->name('login');
        Route::post('/check_user_login', 'LoginController@check_user_login')->name('check_user_login');
        Route::post('/resend_verifiaction_code', 'LoginController@resend_verifiaction_code')->name('resend_verifiaction_code');
        Route::post('/login', 'LoginController@login');
        Route::any('/logout', 'LoginController@logout');//->name('logout');
        Route::post('validate_confirmation', 'LoginController@validateConfirmation')
            ->name('validate_confirmation');
        //Forgot Password Routes
        Route::get('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        //Reset Password Routes
        Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('/password/reset', 'ResetPasswordController@reset')->name('password.update');

        Route::get('/register', 'RegisterController@showRegistrationForm')
            ->name('register');
        Route::post('/register', 'RegisterController@register');

        Route::get('email/verify', 'VerificationController@show')->name('verification.notice');
        Route::get('verify/customer/{field}/{token?}', 'RegisterController@verification');
        Route::post('verify/customer/{field}/{token?}', 'RegisterController@verification');
    });


//common routes
Route::any('/change_language', 'BaseWebController@changeLanguage')->name('change_language');
Route::any('/change_lang/{abbr}', 'BaseWebController@changeLang')->name('change_lang');
Route::any('/change_admin_language', 'BaseWebController@changeLanguage')->name('change_admin_language');

//FOR ALL
Route::group([
    'prefix'     => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect',
                     //adding
                     'verified', 'auth:customers'
    ],
],
    function () {

        Route::group([
            'namespace' => 'Web',
        ],
            function () {
                Route::get('services/main_services', 'ServiceController@listParentServices')
                    ->name('services.main');
                Route::get('/sub_services/{id?}', 'ServiceController@getParentServiceInfo')
                    ->name('sub_services');
                Route::get('/all_services', 'ServiceController@getAllServices');
                Route::get('/all_services/{id?}', 'ServiceController@getServiceInfo')->name('service');
                Route::get('/parent_services', 'ServiceController@listParentServices');
                Route::get('/parent_services/{id?}', 'ServiceController@getParentServiceInfo')
                    ->name('parent_service_info');
                Route::get('/all_services', 'ServiceController@getAllServices')->name('tst_services');
                Route::get('/all_services/{id?}', 'ServiceController@getServiceInfo')
                    ->name('service');
                Route::get('/service_instructions/{id?}', 'ServiceController@getServiceInstructions')
                    ->name('service_instructions');
                //courses
                //moved to web_courses file

                //Consulting
                //moved to web_consultants file


            });
        //AUTH Account Customers Routes Moved to wallet_account file


    });




/*Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');*/


