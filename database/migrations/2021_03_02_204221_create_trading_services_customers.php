<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTradingServicesCustomers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('trading_services_customers',function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->unsignedBigInteger('trading_service_id');//maybe [trading | copy trading]
            $table->foreign('trading_service_id')->references('id')
                ->on('trading_services');
            $table->unsignedBigInteger('trading_agency_id');
            $table->foreign('trading_agency_id')->references('id')
                ->on('trading_agencies');
            $table->string('customer_agency_number')->nullable();
            //mey be the customer end the subscription in service or the admin maybe stop it
            $table->enum('subscription_status',
                [
                    'pending','accepted','rejected_by_admin','rejected_by_agency','canceled_by_customer',
                    'stopped_by_admin',
                ])
                ->default('pending');
            $table->text('status_change_reason')->nullable();
            $table->timestamp('status_change_date')->nullable();
            $table->string('replay_code')->nullable();//if a replay from agency
            $table->text('agency_replay')->nullable();
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
        Schema::dropIfExists('trading_services_customers');
    }
}
