<?php

use Illuminate\Support\Facades\Route;


//AUTH Account Customers Routes
Route::group([
    'prefix'     => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect'],
],
    function () {
        Route::group([
            'prefix'     => 'account',
            'middleware' => ['verified', 'auth:customers'],
            'namespace'  => 'Account',
        ],

            function () {
                //Route::get('/dashboard','ProfileController@dashboardData')->name('profile.dashboard');
                Route::get('/profile/info', 'ProfileController@profileInfo')->name('profile_info');
                // Route::get('/profile/dashboard', 'ProfileController@dashboardData')->name('profile.dashboard');
                Route::get('/profile/dashboard', 'ProfileController@profileInfo')
                    ->middleware('verified')->name('profile.dashboard');
                Route::post('/profile/info', 'ProfileController@updateInfo')
                    ->name('update_profile');
                Route::post('/profile/update_img', 'ProfileController@saveProfileImage')
                    ->name('update_img_profile');
                Route::post('/profile/add_identity_document', 'ProfileController@saveIdentityDocument')
                    ->name('add_identity_document');
                Route::post('/profile/update_identity_document_files', 'ProfileController@updateIdentityDocumentFiles')
                    ->name('update_identity_document_files');
                Route::post('/profile/send-mobile-verification-sms', 'ProfileController@sendMobileVerificationSms')
                    ->name('send_mobile_verification_sms');
                Route::post('/send-error-report', 'ProfileController@sendErrorReport')
                    ->name('send_error_report');
                Route::post('/update-protection-and-security', 'ProfileController@updateProtectionAndSecurity')
                    ->name('update_protection_and_security');
                Route::post('/update_notification', 'ProfileController@update_notification')
                    ->name('update_notification');
                Route::post('/check-user-master-key', 'ProfileController@checkUserMasterKey')
                    ->name('check_user_master_key');
                Route::post('/profile/check-verification-code', 'ProfileController@checkVerificationCode')
                    ->name('check_verification_code');
                Route::post('/profile/update_password', 'ProfileController@updatePassword')
                    ->name('update_password');
                Route::get('finance_accounts', 'ProfileController@list_finance_accounts')
                    ->name('finance_accounts');
                //deprecated
               /* Route::post('update_finance_accounts', 'ProfileController@updateFinanceAccounts')
                    ->name('update_finance_accounts');*/
            });


//Wallet Routes  Authenticated
        Route::group([
            'prefix'     => 'wallet',
            'namespace'  => 'Web',
            'middleware' => ['verified', 'auth:customers']
        ],
            function () {
                //deprecated

                Route::get('/affiliate', function(){
                    return view('affiliate')->with('active_menu', 'affiliate_system');
                })->name('affiliate_system');
                Route::get('/digitalcards', function(){
                    return view('digitalcards')->with('active_menu', 'digitalcards');
                })->name('digitalcards');
                Route::get('/dashboard', 'WalletController@dashboard');//->name('wallet.dashboard');
                Route::get('/', 'WalletController@dashboard')->name('wallet.dashboard');
                Route::get('/notifications', 'WalletController@getNotifications')
                    ->name('notifications');
                Route::get('/notifications/{id}', 'WalletController@markNotificationAsRead')
                    ->name('notification_show');
                Route::get('/add_finance_account', 'WalletController@showAddingFinanceAccount')
                    ->name('wallet.add_finance_account');
                Route::get('/my_accounts', 'WalletController@listFinanceAccounts')
                    ->name("wallet.my_accounts");
                Route::get('/list_finance_account', 'WalletController@listFinanceAccounts')
                    ->name('wallet.myaccounts');

                Route::get('/list_withdraw_agencies_by_method/{method_id?}',
                    'WalletController@getWithdrawAgencyByMethod')
                    ->name("getWithdrawAgencyByMethod");
                Route::post('/save_new_account', 'WalletController@storeFinanceAccount')
                    ->name("wallet.save_new_account");
                Route::get('/my_accounts/{id}', 'WalletController@editFinanceAccount')
                    ->name("wallet.edit_account");
                Route::get('/get_balance', 'WalletController@getCustomerBalance')
                    ->name("get_customer_balance");
                Route::group([
                    'namespace' => 'Wallet',
                ],
                    function () {
                        //deposit steps
                        //  Route::get('/list_deposit_countries','DepositController@listCountriesOfDepositAgencies');
                        Route::get('/deposit', 'DepositController@initDepositOrderData')
                            ->name('show_deposit_form');
                        //deprecated
                        Route::get('/list_agencies_by_country/{country_id}',
                            'DepositController@listAgenciesByCountryId');
                        Route::get('/list_deposit_type_by_agency/{agency_id}',
                            'DepositController@getDepositTypeByAgencyCountry')
                            ->name("getDepositTypeByAgencyCountry");

                        Route::get('/list_deposit_agencies_by_method/{method_id?}',
                            'DepositController@getDepositAgencyByDepositMethod')
                            ->name("getDepositAgencyByDepositMethod");
                        //
                        //Deposit Op Routes
                        Route::get('deposit_orders', 'DepositController@listDepositOrders')
                            ->name('list_deposit_orders');
                        Route::get('deposit_withdraws', 'DepositController@listAllDepositOrders')
                            ->name('list_deposit_withdraws');
                        Route::post('confirm_deposit_order', 'DepositController@confirmDepositOrder')
                            ->name('wallet.confirm_deposit');

                        Route::post('export-pdf-image', 'DepositController@exportPdfImage')
                            ->name('wallet.export_pdf_image');

                        //internal withdraw   steps
                        Route::get('/list_finance_accounts', 'InternalWithdrawController@listFinanceAccounts');
                        Route::get('internal_withdraw_orders', 'InternalWithdrawController@listInternalWithdrawOrders')
                            ->name('list_internal_withdraw_orders');

                        //OPS
                        Route::get('/withdraw2', 'InternalWithdrawController@showWithdrawForm');
                        Route::get('/withdraw_percent/{amount?}/{agency_id?}',
                            'InternalWithdrawController@getWithdrawPercent')->name("withdraw_percent");
                        Route::post('confirm_internal_withdraw_order',
                            'InternalWithdrawController@confirmInternalWithdraw')
                            ->name('confirm_internal_withdraw');

                        //transfer  steps
                        // Route::get('/transfer', 'TransferController@listReceivingAgenciesCountries');
                        Route::get('/list_receiving_countries', 'TransferController@listReceivingAgenciesCountries')->name('transfer_orders');
                        Route::post('/transfer_to_wallet', 'TransferController@transfer_to_wallet')->name('transfer_to_wallet');
                        //هذةما عادتحتاج تجي لها  استخدم wallet/cash   في دروب داون

                        Route::get('/choose_receive_type',
                            'TransferController@chooseReceivingTypes')->name("chooseReceivingTypes");

                        Route::get('/list_receiving_agencies_by_c_type/{country_id?}/{trans_type?}',
                            'TransferController@listReceivingAgenciesByCountryIdReceivingType')->name("list_receiving_agencies_by_c_type");
                        //Transfer Op Routes
                        Route::get('transfer_orders', 'TransferController@listTransferOrders')
                            ->name('list_transfer_orders');
                        Route::post('confirm_transfer', 'TransferController@confirmTransferOrder')
                            ->name('confirm_transfer_order');
                        
                        Route::post('getExchange', 'TransferController@getExchange')
                            ->name('getExchange');


                        //freelancing routes

                        Route::get('list_pull_orders', 'EarningPullController@listEarningPullOrders')
                            ->name('list_pull_earnings_orders');
                        Route::get('pull_earning', 'EarningPullController@initFreelancingForm')
                            ->name('init_free_lancing_form');

                        Route::get('list_payment_bt_platform/{id}',
                            'EarningPullController@listPaymentsGateWayForPlatform')
                            ->name('list_payment_bt_platform');

                        Route::post('freelancing', 'EarningPullController@confirmPullEarningOrder')
                            ->name('save_freelancing');


                        //Paying order routes

                        Route::get('paying_order', 'PayingOrderController@initPayingOrderForm')
                            ->name('show_paying_order');
                        Route::post('confirm_paying', 'PayingOrderController@confirmPayingOrder')
                            ->name('confirm_paying_order');
                        Route::get('confirm_paying_withdraw', 'PayingOrderController@confirmAndWithdraw')
                            ->name('confirm_paying_withdraw');
                        Route::get('list_paying_orders', 'PayingOrderController@listPayingOrders')
                            ->name('paying_orders_list');


                        //for test
                        Route::get('/test_deposit', 'DepositController@showTestDeposit');
                        Route::get('/test_internal_withdraw', 'InternalWithdrawController@showTestInternalWithdraw');
                        Route::get('/test_transfer', 'TransferController@transferTest');
                    });

                //digital_cards_routes

                Route::get('/list_card_categories', 'DigitalCardController@listCardCategories')
                    ->name("cards.list_categories");
                Route::get('/list_providers_category/{cat_id?}', 'DigitalCardController@listProvidersByCategoryID')
                    ->name("cards.list_providers_category");
                Route::get('/list_stores_provider/{provider_id}', 'DigitalCardController@listStoresByProviderID')
                    ->name("cards.list_stores_provider");
                Route::get('/list_packages/{provider_id}/{store_id?}',
                    'DigitalCardController@listDCPackagesByProviderIdStoreId')
                    ->name("cards.list_packages");
                Route::get('/check_d_card_id/{d_card_id}', 'DigitalCardController@checkIsFoundInStock')
                    ->name("cards.check_c_stock");
                Route::post('/store_digital_card_order', 'DigitalCardController@checkoutDigitalCardOrder')
                    ->name("cards.confirm_order");
                Route::get('/list_d_c_orders', 'DigitalCardController@listDigitalCardOrders')
                    ->name("cards.list_orders");

                Route::get('/check_d_card_order/{package_id}/{qty}',
                    'DigitalCardController@checkoutDigitalCardOrder')
                    ->name("cards.check_d_card_order");
                Route::get('/show_d_card_order/{id?}',
                    'DigitalCardController@showDetail')
                    ->name("cards.show_d_card_order");

                Route::get('/my_digital_cards',
                    'DigitalCardController@listDigitalCardOrders')
                    ->name("cards.my_cards");


                //without controllers 7-5  Eman Routes
                //deprecated
                // Route::get('/my_wallet', 'WalletController@my_wallet')->name('wallet.my_wallet');

                Route::get('/get_operation_info', 'WalletController@getOperationInfo')
                    ->name('wallet.get_operation_info');
                Route::get('/currencies', 'WalletController@currencies')->name('wallet.currencies');
                Route::post('/convert-currency', 'WalletController@convertCurrency')->name('wallet.convert_currency');

                //withdraw orders
                //deprecated
                /*  Route::get('/wallet/list_withdraw_orders',
                      'WalletController@listWithdrawOrders')->name('orders.withdraw');
                  //freelancing orders
                  Route::get('/wallet/list_freelancing_orders',
                      'WalletController@listFreelancingOrders')->name('orders.freelancing');

                  // purchase orders
                  Route::get('/wallet/list_purchase_orders',
                      'WalletController@listPurchaseOrders')->name('orders.purchase');*/
               //for test confirm_transfer_order
                Route::post('/saveOrderImage', 'WalletController@saveOrderImage')->name("saveOrderImage");
                //FOR TEST
              /*  Route::get('/transfer_test', 'WalletController@transferTest');
                Route::get('/dc_test', 'DigitalCardController@testOrder');*/
            });
    });








