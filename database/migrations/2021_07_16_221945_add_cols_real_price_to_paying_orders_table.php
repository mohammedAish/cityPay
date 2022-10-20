<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColsRealPriceToPayingOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('paying_orders', function (Blueprint $table) {
            $table->decimal('real_price', 13, 4)->nullable()->after('product_price');
            $table->decimal('final_price', 13, 4)->nullable()->after('commission_fee');
            //it is the deposit_order_id
            $table->unsignedBigInteger('withdraw_id')->after('current_status')->nullable()
                ->comment('the related withdraw id if the op succeed');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('paying_orders', function (Blueprint $table) {
            $table->dropColumn(['real_price', 'final_price', 'withdraw_id']);
        });
    }
}
