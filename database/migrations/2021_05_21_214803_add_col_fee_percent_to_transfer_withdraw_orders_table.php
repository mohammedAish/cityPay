<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColFeePercentToTransferWithdrawOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transfer_withdraw_orders', function (Blueprint $table) {
            $table->decimal('fee_percent',11,2)->nullable()
                ->default(0)->after('transfer_fee');
            $table->decimal('transferred_amount',13,2)
                ->nullable()->default(0)->after('fee_percent');
            $table->unsignedBigInteger('transferred_currency_id')->default(1)
            ->after('transferred_amount')->nullable();
            $table->foreign('transferred_currency_id')->references('id')
                ->on('currencies')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transfer_withdraw_orders', function (Blueprint $table) {
            $table->dropColumn(['fee_percent','transferred_amount','transferred_currency_id']);
        });
    }
}
