<?php


use Illuminate\Support\Facades\Route;

/*Route::get('emailtest/{msg_title}/{content}/{recievedemail}', 'EmailController@send_mail');
Route::post('/Subscribe_newsletter', 'OrgSiteController@Subscribe_newsletter')->name('Subscribe_newsletter');
Route::post('/add_comment_neww', 'PostNewwCommentController@add_comment_neww')->name('add_comment_neww');*/
Route::post('/review_post', 'OrgSiteController@review_post')->name('review_post');
Route::post('/review_author', 'OrgSiteController@review_author')->name('review_author');


Route::get('/old', 'OrgSiteController@oldIndex')
    ->middleware(['localeSessionRedirect', 'localizationRedirect'])
    ->prefix( LaravelLocalization::setLocale())
    ->name('old_index');

Route::group([
    'prefix'     => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'verified', 'auth:customers'],
],
    function () {
        Route::get('/home', 'OrgSiteController@index')->name('home');
        Route::get('/Not-Found-404', 'OrgSiteController@page404')->name('Not-Found-404');
  //      Route::get('/aboutus', 'OrgSiteController@aboutus')->name('aboutus');
  //      Route::get('/news', 'OrgSiteController@news')->name('news');
  //      Route::get('/news_post/{news_post?}', 'OrgSiteController@news_post')->name('news_post');
  //      Route::get('/services', 'OrgSiteController@services')->name('services');
  //      Route::get('/servicePage/{service}', 'OrgSiteController@servicePage')->name('servicePage');
  //      Route::get('/offers', 'OrgSiteController@offers')->name('offers');
 //       Route::get('/blog', 'OrgSiteController@blog')->name('blog');
 //       Route::get('/blog/{category}', 'OrgSiteController@blog_category')->name('blog_category');
   //     Route::get('/blog_post/{post?}', 'OrgSiteController@blog_post')->name('blog_post');
  //      Route::get('/privacyPolicy', 'OrgSiteController@privacyPolicy')->name('privacyPolicy');
  //      Route::get('/accessPolicy', 'OrgSiteController@accessPolicy')->name('accessPolicy');
  //      Route::get('/contact', 'OrgSiteController@contact')->name('contact');
  //      Route::get('/courses', 'OrgSiteController@courses')->name('courses');
  //      Route::get('/singlecourse', 'OrgSiteController@singlecourse')->name('singlecourse');
   //     Route::get('/search', 'OrgSiteController@search')->name('search_site');
        ///////////////////////////trading_end///////////////////////////////////////
    });




