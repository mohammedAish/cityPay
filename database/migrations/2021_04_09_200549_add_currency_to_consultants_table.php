<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCurrencyToConsultantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table('consultants',function (Blueprint $table){
            $table->unsignedBigInteger('currency_id')->nullable()->default(1)->after('price');
            $table->foreign('currency_id')->references('id')
                ->on('currencies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table('consultants',function (Blueprint $table){
            $table->dropColumn('currency_id');
        });
    }
}
