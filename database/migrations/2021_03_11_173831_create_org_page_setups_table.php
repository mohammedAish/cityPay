<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrgPageSetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('org_page_setups', function (Blueprint $table) {
            $table->id();
            $table->string('about_company_title');
            $table->string('about_company_background');
            $table->text('about_company_sub_title');
            $table->text('about_company_keyword');
            $table->string('news_title');
            $table->string('news_background');
            $table->text('news_sub_title');
            $table->text('news_keyword');

            $table->string('services_title');
            $table->string('services_background');
            $table->text('services_sub_title');
            $table->text('services_keyword');

            $table->string('offers_title');
            $table->string('offers_background');
            $table->text('offers_sub_title');
            $table->text('offers_keyword');

            $table->string('blog_title');
            $table->string('blog_background');
            $table->text('blog_sub_title');
            $table->text('blog_keyword');


            $table->string('about_company_title_en');
            $table->text('about_company_sub_title_en');
            $table->text('about_company_keyword_en');
            $table->string('news_title_en');
            $table->text('news_sub_title_en');
            $table->text('news_keyword_en');

            $table->string('services_title_en');
            $table->text('services_sub_title_en');
            $table->text('services_keyword_en');

            $table->string('offers_title_en');
            $table->text('offers_sub_title_en');
            $table->text('offers_keyword_en');

            $table->string('blog_title_en');
            $table->text('blog_sub_title_en');
            $table->text('blog_keyword_en');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('org_page_setups');
    }
}
