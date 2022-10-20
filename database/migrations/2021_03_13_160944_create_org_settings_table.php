<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrgSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('org_settings', function (Blueprint $table) {
            $table->id();
            $table->string('website_title');
            $table->text('website_description');
            $table->text('home_keywords');
            $table->boolean('show_two_lang')->default(1);
            $table->string('logo');
            $table->text('who_us');
            $table->text('mission');
            $table->text('vision');
            $table->string('default_email');
            $table->string('copy_right');
            $table->string('website_title_en');
            $table->text('website_description_en');
            $table->text('home_keywords_en');
            $table->text('who_us_en');
            $table->text('mission_en');
            $table->text('vision_en');
            $table->string('copy_right_en');
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
        Schema::dropIfExists('org_settings');
    }
}
