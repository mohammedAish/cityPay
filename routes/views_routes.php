
<?php

use Illuminate\Support\Facades\Route;
//todo EMAN you must delete any route that is implemented by controllers routes
Route::group([
    'prefix'     => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect','localizationRedirect'],
    'namespace'  => 'Web',
],function (){
//     Route::get('/profile',function (){
//        return view('wallet.profile');
//    });
//    Route::get('/edit_account',function (){
//        return view('wallet.edit_my_account');
//    });
//    Route::get('/lovers_accounts',function (){
//        return view('wallet.faccounts');
//    });
//    Route::get('/edit_lovers',function (){
//        return view('wallet.edit_f_account');
//    });
//    Route::get('/add_lovers',function (){
//        return view('wallet.add_f_account');
//    });
//
//    //            Route::get('/transaction', function () {
//    //                return view('wallet.transaction');
//    //            }); moved
//    Route::get('/transfer-coin',function (){
//        return view('wallet.transfer-coin');
//    });
//    //        Route::get('/deposit', function () {
//    //            return view('wallet.deposit');
//    //        }); moved
//    Route::get('/loyalty',function (){
//        return view('wallet.loyalty');
//    });
//    Route::get('/cashback',function (){
//        return view('wallet.cashback');
//    });
//
//    Route::get('/history',function (){
//        return view('wallet.history');
//    });
//
//
//    Route::get('/crypto-invoice',function (){
//        return view('wallet.crpto-invoice');
//    });
//    /* Route::get('/withdraw2',function (){
//         return view('wallet.withdraw2');
//     });*/
//
//    Route::get('/test-sth',function (){
//        return view('wallet.test');
//    });
//    Route::get('/trading/dashboard',function (){
//        return view('trading.dashboard');
//    });
//    Route::get('/trading/trading-accounts',function (){
//        return view('trading.trading_accounts');
//    });
//    Route::get('/trading/not-sub',function (){
//        return view('trading.not_sub');
//    });
//
//    Route::get('/trading/services',function (){
//        return view('trading.services');
//    });
//
//    Route::get('/trading/cashback',function (){
//        return view('trading.cashback');
//    });
//    Route::get('/trading/copy-trading',function (){
//        return view('trading.copy_trading');
//    });
//


});


//from wob_org

Route::group([
    'prefix'     => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect','localizationRedirect'],
    'namespace'  => 'Web',
],function (){
//    Route::get('/profile/my-consultings',function (){
//        return view('profile.my-consultings');
//    });
//    Route::get('/profile/messages',function (){
//        return view('profile.messages');
//    });
//    Route::get('/profile/personal_doc',function (){
//        return view('profile.personal_doc');
//    });
//    Route::get('/profile/services_management',function (){
//        return view('profile.services_management');
//    });
//    Route::get('/profile/my-digital-cards',function (){
//        return view('profile.my_digital_cards');
//    });

///////////////////////////end_profile///////////////////////////////////////


///////////////////////////newcourses///////////////////////////////////////
//    Route::get('/courses/new/main',function (){
//        return view('courses.newmain');
//    });
//    /* Route::get('/courses/course',function (){
//         return view('courses.course');
//     });*/ //moved
//    /*Route::get('/courses/category',function (){
//        return view('courses.category');
//    });*/ //moved
//   Route::get('/courses/search',function (){
//         return view('courses.search');
//     });


///////////////////////////consulting///////////////////////////////////////
    /*Route::get('/consulting/main',function (){
        return view('consulting.main_consultations');
    });*///moved
//    Route::get('/consulting/course',function (){
//        return view('consulting.course');
//    });
//    Route::get('/consulting/category',function (){
//        return view('consulting.category');
//    });
//    Route::get('/consulting/search',function (){
//        return view('consulting.search');
//    });
//
//    Route::get('/courses/videos',function (){
//        return view('courses.course-area');
//    });
//    Route::get('/courses/my-courses',function (){
//        return view('.profile.my-courses');
//    });
//    Route::get('/trading/brokers',function (){
//        return view('trading.forex_brokers');
//    });
//    Route::get('/trading/message',function (){
//        return view('trading.message');
//    });
//    Route::get('/trading/add_account_new',function (){
//        return view('trading.add_account_new');
//    });
//    Route::get('/trading/broker_detail',function (){
//        return view('trading.broker_detail');
//    });
//        Route::get('/consulting/detail',function (){
//            return view('consulting.detail');
//        });
///////////////////////////end_consulting///////////////////////////////////////


///////////////////////////wallet///////////////////////////////////////


//        Route::get('/wallet/dashboard', function () {
////            return view('wallet.dashboard');
////        }); moved

///////////////////////////end_wallet///////////////////////////////////////
///////////////////////////trading_///////////////////////////////////////

 /*   Route::get('/resetpass',function (){
        return view('auth.passwords.resetpass');
    });



    Route::get('/trading/dashboard',function (){
        return view('trading.dashboard');
    });*/

});
