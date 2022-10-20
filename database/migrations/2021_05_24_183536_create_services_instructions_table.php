<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesInstructionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('services_instructions',function (Blueprint $table){
            $table->id();
            $table->string('service_name',1000);
            $table->enum('steps',['step1','step2','step3','step4','step5'])->default('step1');
            $table->mediumText('instructions')->nullable();
            $table->mediumText('img_path')->nullable();
            //$table->unique(['service_name','steps']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('services_instructions');
    }
}
