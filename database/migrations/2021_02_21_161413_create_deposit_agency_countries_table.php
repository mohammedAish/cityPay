<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositAgencyCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('deposit_agency_countries',function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('deposit_agency_id');
            $table->foreign('deposit_agency_id')
                ->references('id')->on('deposit_agencies');
            $table->unsignedBigInteger('country_id');
            $table->foreign('country_id')
                ->references('id')->on('countries');
            //it may be an email or bank account number for YTadawul
            $table->string('ytadawul_account_number')
                ->comment('ytadawul account number in this country_id for this agency_id');
            $table->text('description')->nullable()
                ->comment('here will show the description for client how will we receive deposit from him');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('deposit_agency_countries');
    }
}
