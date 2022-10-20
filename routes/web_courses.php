<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix'     => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect','auth:customers'],
    'namespace'  => 'Web',
],

    function () {
        Route::get('/courses/main', 'CourseController@mainCourses')->name('courses.main');
        Route::get('/courses/{course_id?}', 'CourseController@courseInfo')->name('courses.detail');
        Route::get('/courses/category/{cat_id?}', 'CourseController@categoryCourses')->name('courses.category');
        Route::get('/courses/search/{any?}', 'CourseController@searchInCourses');
        Route::get('/instructors/{id?}', 'CourseController@courseInstructorInfo');
        Route::get('courses/checkout/{course_id?}', 'CourseController@courseCheckout')->name('courses.checkout');

            //App\Http\Controllers\Web\Courses
        //Auth Routes
        Route::group([
            'prefix'     => 'courses',
            'namespace'  => 'Courses',
          //  'middleware' => ['auth:customers','verified'],
        ], function () {
            Route::group([
            ], function () {
                Route::get('new_my-courses', 'CustomerCourseController@listMyCourses')
                    ->name('profile.my_courses');
                Route::get('my-courses', 'CustomerCourseController@listMyCourses')->name('profiemanle.my_courses');
                Route::post('play_subject/{course_id?}/{subject_id?}',
                    'CustomerCourseController@playCourseSubject')->name('play_subject');
                Route::post('checkout', 'CustomerCourseController@courseOrder')->name('courses.buy');
                Route::post('add-comment', 'CustomerCourseController@addComment')->name('courses.add-comment');
                Route::get('course_area/{course_id?}',
                    'CustomerCourseController@courseWithSubjectInfo')->name('courses.area');

            });
        });
    });


