<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFeeColsToDepositOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table('deposit_orders',function (Blueprint $table){
            $table->decimal('fee_percent',5,2)->default(0)
                ->after('exchange_price');
            $table->decimal('withdraw_fee',13,2)->default(0)
                ->after('fee_percent');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table('deposit_orders',function (Blueprint $table){
            $table->dropColumn(['fee_percent','withdraw_fee']);
        });
    }
}
