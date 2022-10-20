<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColClientAmountToDepositOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deposit_orders', function (Blueprint $table) {
            $table->decimal('client_amount',13,2)->default(0)
                ->after('currency_id')
                ->comment(' the amount that must paied from client ');
            $table->unsignedBigInteger('cl_amount_curr_id')->nullable()
            ->after('client_amount');
            $table->foreign('cl_amount_curr_id','cl_amount_curr_id_currencies_FK')
                ->on('currencies')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deposit_orders', function (Blueprint $table) {
            $table->dropForeign('cl_amount_curr_id_currencies_FK');
            $table->dropColumn(['client_amount','cl_amount_curr_id']);
        });
    }
}
