<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayingOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('paying_orders',function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')
                ->on('customers');
            $table->string('product_name')->nullable();
            $table->decimal('product_price',13,2);
            $table->unsignedBigInteger('currency_id')->default(1);
            $table->foreign('currency_id')->references('id')->on('currencies')
                ->onUpdate('cascade');
            $table->decimal('commission_percent',5,2)->nullable()->default(0);
            $table->decimal('commission_fee',11,2)->nullable()->default(0);
            $table->text('description')->nullable()
                ->comment('this will fill by customer');
            $table->text('link_url')->nullable();
            $table->text('file_path')->nullable();
            $table->enum('current_status',array_keys(config('ytadawul.order_status')));
            $table->unsignedBigInteger('admin_id')->nullable()
                ->comment('who process the order');
            $table->foreign('admin_id')->references('id')
                ->on('users');
            $table->text('admin_note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('paying_orders');
    }
}
