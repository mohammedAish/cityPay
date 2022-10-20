<?php
Route::middleware(['admin', 'web'])->group(function () {
    Route::name('admin.')->group(function () {
        // Frontend
        Route::name('frontend.')->prefix('admin')
                    ->group(function () {
            Route::post('store', 'FrontEndCrudController@store')->name('store');
            Route::post('remove', 'FrontEndCrudController@remove')->name('remove');
            Route::post('{id}/update', 'FrontEndCrudController@update')->name('update');

            // FAQ
            Route::get('faq', 'FrontEndCrudController@faqIndex')->name('faq.index');
            Route::get('faq/{id}/{slug}/edit', 'FrontEndCrudController@faqEdit')->name('faq.edit');
            Route::get('faq/new', 'FrontEndCrudController@faqNew')->name('faq.new');

            // Blog
            Route::get('announce/', 'FrontEndCrudController@announceIndex')->name('blog.index');
            Route::get('announce/edit/{id}/{slug}', 'FrontEndCrudController@announceEdit')->name('blog.edit');
            Route::get('announce/new', 'FrontEndCrudController@announceNew')->name('blog.new');

            // Our Team
            Route::get('team/', 'FrontEndCrudController@teamIndex')->name('team.index');
            Route::get('team/edit/{id}/{slug}', 'FrontEndCrudController@teamEdit')->name('team.edit');
            Route::get('team/new', 'FrontEndCrudController@teamNew')->name('team.new');


            // Company policy
            Route::get('company_policy/', 'FrontEndCrudController@companyPolicy')->name('companyPolicy.index');
            Route::get('company_policy/{id}/{slug}/edit',
                'FrontEndCrudController@companyPolicyEdit')->name('companyPolicy.edit');
            Route::get('company_policy/new', 'FrontEndCrudController@companyPolicyNew')->name('companyPolicy.new');

            // Manage Menu
            Route::get('menu/', 'FrontEndCrudController@menu')->name('menu.index');
            Route::get('menu/{id}/{slug}/edit', 'FrontEndCrudController@menuEdit')->name('menu.edit');
            Route::get('menu/new', 'FrontEndCrudController@menuNew')->name('menu.new');

            Route::get('contact', 'FrontEndCrudController@sectionContact')->name('section.contact.edit');

            Route::get('homeContent', 'FrontEndCrudController@homeContent')->name('homeContent');

            Route::get('about', 'FrontEndCrudController@sectionAbout')->name('about.edit');
            Route::post('about/{id}/update', 'FrontEndCrudController@sectionAboutUpdate')->name('about.update');

            Route::get('background-image', 'FrontEndCrudController@bgImage')->name('bg.image.edit');
            Route::post('background/image/update', 'FrontEndCrudController@bgImageUpdate')->name('bg.image.update');

            // SEO
            Route::get('seo', 'FrontEndCrudController@seoEdit')->name('seo.edit');

            // Social
            Route::get('social', 'FrontEndCrudController@socialIndex')->name('social.index');

            // Testimonial
            Route::get('testimonial', 'FrontEndCrudController@testimonialIndex')->name('testimonial.index');
            Route::get('testimonial/new', 'FrontEndCrudController@testimonialNew')->name('testimonial.new');
            Route::get('testimonial/edit/{id}', 'FrontEndCrudController@testimonialEdit')->name('testimonial.edit');


            // why choose us
            Route::get('services', 'FrontEndCrudController@whychooseIndex')->name('whychoose.index');

            // Flow Step
            Route::get('flowstep', 'FrontEndCrudController@flowstepIndex')->name('flowstep.index');
            Route::get('process/new', 'FrontEndCrudController@flowstepNew')->name('flowstep.new');
            Route::get('frontend/flowstep/edit/{id}', 'FrontEndCrudController@flowstepIndex')->name('flowstep.edit');


            // how it work
            Route::get('whychooseus', 'FrontEndCrudController@howitworkIndex')->name('howitwork.index');
            Route::get('whychooseus/new', 'FrontEndCrudController@howitworkNew')->name('howitwork.new');
            Route::get('whychooseus/edit/{id}', 'FrontEndCrudController@howitworkEdit')->name('howitwork.edit');

        });
    });
});