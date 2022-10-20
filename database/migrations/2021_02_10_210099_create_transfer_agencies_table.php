<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransferAgenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('transfer_agencies',function (Blueprint $table){
            $table->id();
            $table->string('agency_name',1000);
            $table->text('agency_desc')->nullable();
            $table->text('img_path')->nullable();
            //banki =>cash,electroni=>wallet ,both=>wallet&cash
            $table->enum('receive_method',['cash','wallet','both'])->default('both'); $table->boolean('active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('transfer_agencies');
    }
}
