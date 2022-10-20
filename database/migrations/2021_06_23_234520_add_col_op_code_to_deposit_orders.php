<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColOpCodeToDepositOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deposit_orders', function (Blueprint $table) {
          $table->string('op_code')->nullable()->unique()->after('op_type');
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
            $table->dropColumn('op_code');
        });
    }
}
