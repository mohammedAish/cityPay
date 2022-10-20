<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Consulting,course_training,service_paying,pull_earning,depositing_services,other
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name',1000);
            $table->text('short_description')->nullable();

            $table->text('description')->nullable();
            $table->unsignedBigInteger('parent_service_id');
            $table->foreign('parent_service_id')->references('id')
                ->on('parent_services')
                //->onDelete('cascade')->onUpdate('cascade') //to prevent delete
            ;
            $table->enum('price_type',['free','paid'])->default('free');
            $table->text('img_path')->nullable();
            $table->text('img_path_en')->nullable();
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
        Schema::dropIfExists('services');
    }
}
