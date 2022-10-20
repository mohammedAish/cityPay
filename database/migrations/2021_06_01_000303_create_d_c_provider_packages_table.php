<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDCProviderPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('d_c_provider_packages',function (Blueprint $table){
            $table->id();
            //must be contain d_card_provider_id
            $table->unsignedBigInteger('d_card_provider_id');
            $table->foreign('d_card_provider_id')
                ->references('id')->on('digital_cards_providers');
            $table->unsignedBigInteger('store_id');
            $table->foreign('store_id')
                ->references('id')->on('digital_card_stores');
            $table->string('name',1000);
            $table->decimal('price',13,2);
            $table->unsignedBigInteger('currency_id');
            $table->foreign('currency_id')->references('id')
                ->on('currencies');
            $table->text('img_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('d_c_provider_packages');
    }
}
