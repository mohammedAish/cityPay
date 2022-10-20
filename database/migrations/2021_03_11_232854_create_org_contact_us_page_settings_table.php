<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrgContactUsPageSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('org_contact_us_page_settings', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->text('first_paragraph');
            $table->text('second_paragraph');
            $table->string('phone');
            $table->string('whatsapp');
            $table->string('support_email');
            $table->string('title_en');
            $table->text('first_paragraph_en');
            $table->text('second_paragraph_en');
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
        Schema::dropIfExists('org_contact_us_page_settings');
    }
}
