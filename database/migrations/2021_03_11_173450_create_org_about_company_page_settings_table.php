<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrgAboutCompanyPageSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('org_about_company_page_settings', function (Blueprint $table) {
            $table->id();
            $table->string('trade_mark_title');
            $table->text('trade_mark_desc');
            $table->string('Definition_company_title');
            $table->text('Definition_company_desc');

            $table->string('trade_mark_title_en');
            $table->text('trade_mark_desc_en');
            $table->string('Definition_company_title_en');
            $table->text('Definition_company_desc_en');

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
        Schema::dropIfExists('org_about_company_page_settings');
    }
}
