<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrgOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('org_offers',function (Blueprint $table){
            $table->id();
            $table->string('offer_title');
            $table->boolean('activated')->default(1);
            $table->string('offer_logo')->nullable();
            $table->string('offer_discount_text');
            $table->string('offer_small_description');
            $table->string('offer_desc_title');
            $table->longText('offer_desc');
            $table->integer('old_price')->nullable();
            $table->integer('discount_rate')->nullable();
            $table->integer('new_price')->nullable();
            $table->string('offer_currency')->default('$');
            $table->integer('offer_period')->nullable();
            $table->string('finish_date')->nullable();
            $table->string('offer_button_text')->nullable();
            $table->string('offer_button_link')->nullable();
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
        Schema::dropIfExists('org_offers');
    }
}
