<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDigitalCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('digital_cards',function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('provider_id');
            $table->foreign('provider_id')->references('id')
                ->on('digital_cards_providers')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name',2000)->nullable();
            $table->text('description')->nullable();
            $table->text('img_path')->nullable();
           // $table->text('img_path_en')->nullable();
            $table->decimal('price',11,2)->default(0);
            $table->unsignedBigInteger('currency_id');
            $table->foreign('currency_id')->references('id')
                ->on('currencies');
            //->onDelete('cascade')->onUpdate('cascade');
            $table->decimal('discount',11,2)->default(0);
            $table->decimal('bound_value',11,2)->nullable()
                ->comment('amount or the value of card per to 1USD dollar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('digital_cards');
    }
}
