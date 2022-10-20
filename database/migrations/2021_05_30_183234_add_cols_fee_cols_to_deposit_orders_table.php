<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColsFeeColsToDepositOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table('deposit_orders',function (Blueprint $table){
            $table->renameColumn('withdraw_fee','fee_amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table('deposit_orders',function (Blueprint $table){
            $table->renameColumn('fee_amount','withdraw_fee');

        });
    }
}
