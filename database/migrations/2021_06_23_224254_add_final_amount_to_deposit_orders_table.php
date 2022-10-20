<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFinalAmountToDepositOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deposit_orders', function (Blueprint $table) {
            $table->decimal('final_amount',13,2)->after('fee_amount')
                ->default(0)
                ->comment('the amount after the op plus the comms');
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
            $table->dropColumn('final_amount');
        });
    }
}
