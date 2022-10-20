<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDigitalCardStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('digital_card_stores', function (Blueprint $table) {
            $table->id();
            //we dont need it
           /* $table->unsignedBigInteger('d_card_provider_id');
            $table->foreign('d_card_provider_id')
                ->references('id')->on('digital_cards_providers');*/
            $table->string('name',1000);
            $table->boolean('shown')->default(1)
            ->comment('if true then there are other stores for this provider');
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
        Schema::dropIfExists('digital_card_stores');
    }
}
