<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerDCOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //deprecated
    public function up(){
        Schema::create('customer_d_c_order_details',function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')
                ->on('customer_d_c_orders');
            $table->unsignedBigInteger('digital_card_id');
            $table->foreign('digital_card_id')->references('id')
                ->on('digital_cards');
            $table->string('card_code')->nullable()
                ->comment('when order accept and admin will put code here');
            $table->text('description')
                ->comment('instruction about using')->nullable();
            $table->decimal('cost_price',13,2)->nullable();
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->foreign('currency_id')->references('id')
                ->on('currencies');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('customer_d_c_order_details');
    }
}
