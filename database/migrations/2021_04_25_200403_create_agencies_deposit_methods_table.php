<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgenciesDepositMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('deposit_agencies_methods',function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('deposit_agency_id');
            $table->foreign('deposit_agency_id')->references('id')
                ->on('deposit_agencies')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('deposit_method_id');
            $table->foreign('deposit_method_id')->references('id')
                ->on('deposit_methods')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('deposit_agencies_methods');
    }
}
