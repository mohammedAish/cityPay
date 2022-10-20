<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTradingAgencyServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table('trading_services_customers',function (Blueprint $table){
            $table->dropForeign('trading_services_customers_trading_service_id_foreign');
            $table->dropColumn('trading_service_id');
        });
        Schema::create('trading_agency_services',function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('trading_service_id');//maybe [trading | copy trading]
            $table->foreign('trading_service_id')->references('id')
                ->on('trading_services');
            $table->unsignedBigInteger('trading_agency_id');
            $table->foreign('trading_agency_id')->references('id')
                ->on('trading_agencies');
            //for future
            $table->unsignedInteger('loyalty_points')
                ->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table('trading_services_customers',function (Blueprint $table){
            $table->unsignedBigInteger('trading_service_id')
            ->after('customer_id');//maybe [trading | copy trading]
            $table->foreign('trading_service_id','trading_services_customers_trading_service_id_foreign')->references('id')
                ->on('trading_services');
        });
        Schema::dropIfExists('trading_agency_services');
    }
}
