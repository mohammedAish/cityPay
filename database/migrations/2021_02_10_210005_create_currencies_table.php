<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('currencies',function (Blueprint $table){
            $table->id();
            $table->string('name',100);
            $table->string('name_en',100);
            $table->string('code',6)->unique();
            $table->string('symbol')->nullable();
            $table->decimal('exchange_price',8,2)->default(1);
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
        Schema::dropIfExists('currencies');
    }
}
