<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWithdrawColsToDepositAgenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table('deposit_agencies',function (Blueprint $table){
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
        });
        Schema::table('deposit_agencies',function (Blueprint $table){
            $table->string('ytadawul_account_number')->nullable();
            $table->string('ytadawul_account_name')->nullable();
            $table->decimal('deposit_fee_percent',10,2)->default(0);
            $table->decimal('withdraw_fee_percent',10,2)->default(0);
            $table->unsignedDecimal('min_deposit_amount',14,2)->default(0.0000001);
            $table->unsignedDecimal('max_deposit_amount',14,2)->default(100000);
            $table->unsignedDecimal('min_withdraw_amount',14,2)->default(0.0000001);
            $table->unsignedDecimal('max_withdraw_amount',14,2)->default(100000);
            $table->text('deposit_instructions')->nullable();
            $table->text('withdraw_instructions')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table('deposit_agencies',function (Blueprint $table){
            //
        });
    }
}
