<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColCardsToCustomerDCOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table('customer_d_c_orders',function (Blueprint $table){
            $table->mediumText('cards_codes')->nullable()
                ->after('total_amount')
                ->comment('will fill during buying the cards');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table('customer_d_c_orders',function (Blueprint $table){
            $table->dropColumn('cards_codes');
        });
    }
}
