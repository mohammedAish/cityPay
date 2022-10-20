<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTradingAgenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('trading_agencies',function (Blueprint $table){
            $table->id();
            $table->string('name',2000);
            $table->text('description')->nullable();
            $table->text('img_path')->nullable();
            //deprecated
            $table->text('img_path_en')->nullable();
            $table->text('primary_email')->nullable();
            $table->text('secondary_mail')->nullable();
            $table->string('phone1')->nullable();
            $table->string('phone2')->nullable();
            $table->text('contact_info')->nullable();
            $table->text('email_from_yt_to')->nullable();
            $table->text('email_from_cust_to')->nullable();
            $table->text('agency_terms')->nullable()
                ->comment('if there term in agency');
            $table->boolean('active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('trading_agencies');
    }
}
