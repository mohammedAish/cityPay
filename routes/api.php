<?php



$api = app('Dingo\Api\Routing\Router');


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
$GLOBALS['route_locale'] = app('laravellocalization')->setLocale();
$api->version('v1',function ($api){
    $api->group([
        'prefix' => $GLOBALS['route_locale'],
    ],
        function ($api){
            $api->group([
                "namespace" => 'App\Http\Controllers\Api',
            ],function ($api){
                $api->get('home_site_data','OrgSiteApiController@getAllHomePageData');
                $api->get('about_us','OrgSiteApiController@aboutUs');
                $api->get('privacy_policy','OrgSiteApiController@privacyPolicy');
                $api->get('access_policy','OrgSiteApiController@accessPolicy');
                $api->get('contact_us','OrgSiteApiController@contactUs');
                $api->get('get_all_news','OrgSiteApiController@listNews');
                $api->get('show_news/{id?}','OrgSiteApiController@showNew');
                $api->get('list_blog','OrgSiteApiController@listBlog');
                $api->get('blog_category/{cat_id?}','OrgSiteApiController@blogCategory');
                $api->get('get_site_setting','OrgSiteApiController@getSiteSettings');
                $api->get('get_site_slides','OrgSiteApiController@listSlides');
                $api->post('auth/login','AuthController@login')->middleware('assign.guard:api');

                //our api
                $api->get('get_countries','MiscApiController@getCountries');
                $api->get('get_languages','MiscApiController@getLanguages');


                $api->get('get_parent_services','ServicesApiController@getParentServices');
                //consultants
                $api->get('consultants','ConsultingApiController@index');
                $api->get('consultants/cat/{cat_id?}','ConsultingApiController@consultantsCategory');
                $api->get('consultants/{id?}','ConsultingApiController@consultantInfo');
                //courses
                $api->get('courses','CourseApiController@index');
                $api->get('courses/cat/{cat_id?}','CourseApiController@categoryCourses');
                $api->get('courses/{id?}','CourseApiController@courseInfo');


                // register
                $api->post('register','AuthController@register');
            });
        });


    //API AUTH
    $api->group([
        'middleware' => ['auth.jwt','assign.guard:api'],
        'prefix'     => 'auth',"namespace" => 'App\Http\Controllers\Api',
    ],function ($api){
        $api->get('profile','AccountApiController@dashboard');
        $api->post('logout','AuthController@logout');
        $api->post('refresh','AuthController@refresh');
        $api->post('me','AuthController@me');
        $api->post('get_profile_info','AccountApiController@getProfileInfo');
        $api->post('update_profile','AccountApiController@updateInfo');
        $api->post('dashboard_info','AccountApiController@dashboardApp');
    });
    //API AUTHENTICATED ROUTS
    $api->group([
        'prefix'     => $GLOBALS['route_locale'],
        'middleware' => ['auth.jwt','assign.guard:api'],
        "namespace"  => 'App\Http\Controllers\Api',
    ],function ($api){
        //order api routes
        $api->post('order_course','CustomerOrderApiController@courseOrder');
        $api->post('order_consultant','CustomerOrderApiController@consultantOrder');
        $api->post('checkout_consultant','CustomerOrderApiController@checkoutConsultant');
        $api->post('order_digital_card','CustomerOrderApiController@orderDigitalCard');
    });

    //wallet routes
    $api->group([
        'prefix'     => $GLOBALS['route_locale'].'/wallet',
        'middleware' => ['auth.jwt','assign.guard:api'],
        "namespace"  => 'App\Http\Controllers\Api\Wallet',
    ],function ($api){
        //order api routes
        //WALLET
        // $api->get('/list_deposit_countries','DepositApiController@listCountriesOfDepositAgencies');

        $api->get('/list_agencies_by_country/{country_id?}','DepositApiController@listAgenciesByCountryId');
        $api->get('/deposit','DepositApiController@initDepositData');

        $api->get('/list_deposit_type_by_agency/{agency_id}',
            'DepositApiController@getDepositTypeByAgencyCountry');
        $api->get('/list_deposit_orders','DepositApiController@listDepositOrders');
        $api->post('confirm_deposit_order','DepositApiController@confirmDepositOrder');


        //deprecated $api->get('/list_receiving_countries','DepositApiController@listReceivingAgenciesCountries');
        $api->get('/transfer','TransferApiController@initTransferData');
        $api->get('/choose_receive_type','TransferApiController@chooseReceivingTypes');

        $api->get('/list_receiving_agencies_by_c_type/{country_id?}/{trans_type?}',
            'TransferApiController@listReceivingAgenciesByCountryIdReceivingType');
        $api->post('confirm_transfer','TransferApiController@confirmTransferApiOrder');
        $api->get('transfer_orders','TransferApiController@listTransferOrders');
        //todo ZAHER complete the api for finance adding
       /* Route::get('/add_finance_account', 'WalletController@showAddingFinanceAccount')
            ->name('wallet.add_finance_account');
        Route::get('/list_finance_account', 'WalletController@listFinanceAccounts')
            ->name('wallet.myaccounts');
        //todo Osama this is new function for add new finance account
        Route::get('/list_withdraw_agencies_by_method/{method_id?}',
            'WalletController@getWithdrawAgencyByMethod')
            ->name("getWithdrawAgencyByMethod");
        Route::post('/save_new_account', 'WalletController@storeFinanceAccount')
            ->name("wallet.save_new_account");*/



        //withdraw
        $api->get('/list_finance_accounts','InternalWithdrawApiController@listFinanceAccounts');

        $api->get('withdraw_orders','InternalWithdrawApiController@listInternalWithdrawOrders');

        //OPS
        $api->get('/init_withdraw','InternalWithdrawApiController@listFinanceAccounts');
        $api->get('/withdraw_percent/{amount?}/{agency_id?}',
            'InternalWithdrawApiController@getWithdrawPercent');
        $api->post('confirm_withdraw_order',
            'InternalWithdrawApiController@confirmInternalWithdraw');

        //freelancing routes
        $api->get('freelancing','EarningPullApiController@initFreelancingData');
        $api->get('get_payment_gateways_platform/{platform_id?}',
            'EarningPullApiController@listPaymentsGateWayForPlatform');
        $api->post('confirm_pull_earning','EarningPullApiController@confirmPullEarningOrder');

        //Paying order routes
        $api->get('paying_order','PayingOrderApiController@initPayingOrderForm');
        $api->post('confirm_paying','PayingOrderApiController@confirmPayingOrder');
        $api->get('list_paying_orders','PayingOrderApiController@listPayingOrders');
    });
    $api->group([
        'prefix'    => $GLOBALS['route_locale'].'',
        //   'middleware' => ['auth.jwt','assign.guard:api'],
        "namespace" => 'App\Http\Controllers\Api',
    ],function ($api){
        //digital_card-routes

        $api->get('/list_card_categories','DigitalCardApiController@listCardCategories');
        $api->get('/list_providers_category/{cat_id?}','DigitalCardApiController@listProvidersByCategoryID');
        $api->get('/list_stores_provider/{provider_id}','DigitalCardApiController@listStoresByProviderID');
        $api->get('/list_packages/{provider_id}/{store_id?}',
            'DigitalCardApiController@listDCPackagesByProviderIdStoreId');

        //todo change tot post
        $api->get('/check_d_card_id/{d_card_id}','DigitalCardApiController@checkIsFoundInStock');
        $api->post('/store_digital_card_order','DigitalCardApiController@checkoutDigitalCardOrder');
        $api->get('/list_d_c_orders','DigitalCardApiController@listDigitalCardOrders');


        //TradingRoutes
        $api->get('/list_trading_agencies','TradingApiController@listTradingAgencies');
        $api->get('/list_trading_services','TradingApiController@listTradingServices');
        $api->get('/list_my_subscriptions_services','TradingApiController@listTradingSubscriptions');
        $api->post('/subscription_order','TradingApiController@storeSubscriptionOrder');
        $api->post('/create_agency_account','TradingApiController@storeTradingAgencyAccountOrder');
        $api->get('/list_my_agencies_accounts','TradingApiController@listTradingAgencyAccountsOrders');
        $api->get('/list_trading_service_ops','TradingApiController@listTradingServiceOperations');
        $api->post('/transfer_op_points','TradingApiController@transferTradingPointsLoyalties');
        $api->get('/list_alive_broadcasting','TradingApiController@listActiveLiveTradings');
        $api->post('/coming_live_trading','TradingApiController@storeComingLiveTrading');
        $api->post('/rate_live_broadcast','TradingApiController@rateLiveTrading');
        $api->get('/list_my_live_subscriptions','TradingApiController@listCustomerBroadcasting');
        $api->get('/show_live_info/{live_id?}','TradingApiController@showLiveTradingInfo');
    });
});
