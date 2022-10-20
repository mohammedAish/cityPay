<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoyaltyPointsPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('loyalty_points_prices',function (Blueprint $table){
            $table->id();
            $table->decimal('from',15,2);
            $table->decimal('to',15,2);
            $table->decimal('price',15,2)->default(0);
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('loyalty_points_prices');
    }
}
