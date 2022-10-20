<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDigitalCardsProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('digital_cards_providers',function (Blueprint $table){
            $table->id();
            $table->string('name',2000);
            $table->text('description')->nullable();
            $table->text('img_path')->nullable();
            $table->text('img_path_en')->nullable();
            $table->boolean('active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('digital_cards_providers');
    }
}
