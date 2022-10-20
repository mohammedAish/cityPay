<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFixedChargeToDepositAgencies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table('deposit_agencies',function (Blueprint $table){
            $table->unsignedDecimal('fixed_charge_deposit',11,2)->default(0)
                ->after('deposit_fee_percent')
                ->comment('when deposit maybe want to put charge as fixed amount');
            $table->unsignedDecimal('fixed_charge_withdraw',11,2)->default(0)
                ->after('withdraw_fee_percent')
                ->comment('when withdraw maybe want to put charge as fixed amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table('deposit_agencies',function (Blueprint $table){
            $table->dropColumn(['deposit_fee_percent','withdraw_fee_percent']);
        });
    }
}
