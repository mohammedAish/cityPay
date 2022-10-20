<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLoyaltyToCustomersLoyaltyPointsPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table('customers_loyalty_points_prices',function (Blueprint $table){
            $table->morphs('loyaltyable','cust_loyalty_ops_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table('customers_loyalty_points_prices',function (Blueprint $table){
            $table->dropMorphs('loyaltyable');
        });
    }
}
