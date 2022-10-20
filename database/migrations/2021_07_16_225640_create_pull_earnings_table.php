<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePullEarningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('pull_earnings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->unsignedBigInteger('freelancing_platform_id');
            $table->foreign('freelancing_platform_id')->references('id')->on('freelancing_platforms');
            $table->decimal('amount', 13, 4);
            $table->unsignedBigInteger('currency_id')->default(1);
            $table->foreign('currency_id')->references('id')->on('currencies')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('deposit_order_id')->comment('when register order must have deposit order');
            $table->foreign('deposit_order_id')->references('id')->on('deposit_orders')
                ->onUpdate('cascade');
            $table->text('admin_note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('pull_earnings');
    }
}
