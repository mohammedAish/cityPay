<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrgSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('org_sliders',function (Blueprint $table){
            $table->id();
            $table->string('title',2000);
            $table->longText('description')->nullable();
            $table->string('image')->nullable();
            $table->string('image_en')->nullable();
            $table->boolean('showSlide')->default(false);
            $table->string('button_text')->nullable();
            $table->string('button_link')->nullable();
            $table->enum('language',['ar','en'])->default('ar');
            $table->bigInteger('original_row')->nullable();
            $table->boolean('translated')->default(false);
            $table->bigInteger('translated_id')->nullable();
            $table->biginteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('org_sliders');
    }
}
