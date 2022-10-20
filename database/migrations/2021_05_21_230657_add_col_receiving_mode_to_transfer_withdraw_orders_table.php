<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColReceivingModeToTransferWithdrawOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        DB::statement("ALTER TABLE transfer_withdraw_orders MODIFY
        COLUMN transfer_type ENUM('transfer','withdraw') default 'transfer'");

        Schema::table('transfer_withdraw_orders',function (Blueprint $table){

          //  $table->enum('transfer_type',['transfer','withdraw'])->default('withdraw')->change();
            $table->enum('receiving_mode',['cash','wallet'])->default('cash')
                ->after('transfer_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table('transfer_withdraw_orders',function (Blueprint $table){
            $table->dropColumn('receiving_mode');
        });
    }
}
