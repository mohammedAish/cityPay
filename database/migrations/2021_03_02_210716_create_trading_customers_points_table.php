<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTradingCustomersPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('trading_customers_points',function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->unsignedBigInteger('trading_service_id')->nullable();//maybe [trading | copy trading]
            $table->foreign('trading_service_id')->references('id')->on('trading_services');
            $table->unsignedBigInteger('trading_agency_id')->nullable();
            $table->foreign('trading_agency_id')->references('id')
                ->on('trading_agencies');
            $table->string('operation_number');//in the trading_services//@todo why this
            //the loyalty_points will customer git
            $table->decimal('loyalty_points',11,2)->default(0);
            $table->decimal('dollar_equal',11,2)->default(0);
            $table->boolean('transferred')->default(0);
            $table->enum('win_lose',['win','lose'])->default('win');//ربح أو خسارة
            $table->timestamp('transferred_date')->comment('when convert to usd');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('trading_customers_points');
    }
}
