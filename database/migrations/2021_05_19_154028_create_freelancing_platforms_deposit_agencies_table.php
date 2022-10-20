<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFreelancingPlatformsDepositAgenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('freelancing_platforms_deposit_agencies',function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('freelancing_platform_id');
            $table->foreign('freelancing_platform_id','free_plat_FK')->references('id')
                ->on('freelancing_platforms');
            $table->unsignedBigInteger('deposit_agency_id');
            $table->foreign('deposit_agency_id','free_agencies_FK')->references('id')
                ->on('deposit_agencies');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('freelancing_platforms_deposit_agencies');
    }
}
