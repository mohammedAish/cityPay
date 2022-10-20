<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColServiceIdToTradingServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table('trading_services',function (Blueprint $table){
            $table->unsignedBigInteger('common_service_id')->nullable()
                ->after('name')->default('7');//خدمة التداول الحي
            $table->foreign('common_service_id','trading_services_common_service_FK')->references('id')->on('services');
            $table->boolean('is_operational')->default(0)->nullable()->after('common_service_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table('trading_services',function (Blueprint $table){
            $table->dropForeign('trading_services_common_service_FK'); // Drop foreign key 'user_id' from 'posts' table
            $table->dropColumn('common_service_id');
            $table->dropColumn('is_operational');

        });
    }
}
