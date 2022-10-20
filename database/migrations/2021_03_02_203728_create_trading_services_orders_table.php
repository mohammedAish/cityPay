<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTradingServicesOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('trading_services_orders',function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->unsignedBigInteger('trading_service_id');
            $table->foreign('trading_service_id')->references('id')->on('trading_services');
            //stopped when accepted and the admin stop it
            $table->enum('order_status',['pending','accepted','rejected','stopped'])->default('pending');
            $table->text('status_change_reason')->nullable();
            $table->timestamp('status_change_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('trading_services_orders');
    }
}
