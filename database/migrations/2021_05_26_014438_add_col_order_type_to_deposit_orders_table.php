<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColOrderTypeToDepositOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deposit_orders', function (Blueprint $table) {
            $table->enum('order_type',
                ['normal_deposit','normal_withdraw','pull_earning','paying_order']
                )->after('op_type')->default('normal_deposit')
                ->comment('this col to know the deposit type not ..');
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
            $table->dropColumn('order_type');
        });
    }
}
