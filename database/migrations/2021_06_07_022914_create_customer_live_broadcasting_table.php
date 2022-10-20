<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerLiveBroadcastingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('customer_live_broadcasting',function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')
                ->on('customers');
            $table->unsignedBigInteger('live_broadcasting_id')->nullable();
            $table->foreign('live_broadcasting_id','cust_live_broadcasting_id_fk')
                ->references('id')->on('live_broadcasting');
            $table->decimal('rating')->nullable()->default(5);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('customer_live_broadcasting');
    }
}
