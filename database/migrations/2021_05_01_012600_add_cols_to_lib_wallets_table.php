<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColsToLibWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table('lib_transactions',function (Blueprint $table){
            $table->enum('reference_type',
                [
                    'normal_transaction',
                    'course_order',
                    'consulting_order',
                    'deposit_order',
                    'transfer_order',
                    'withdraw_order',
                    'd_card_parches_order',
                    'loyalty_point_transform',
                    'trading_cash_order',
                    'trading_live_order',
                    'trading_marketing_order',
                ])->default('normal_transaction')->after('meta');
            $table->unsignedBigInteger('reference_id')->after('reference_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table('lib_wallets',function (Blueprint $table){
            $table->dropColumn('reference_id','reference_type');
        });
    }
}
