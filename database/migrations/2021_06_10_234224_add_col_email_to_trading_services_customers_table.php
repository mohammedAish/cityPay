<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColEmailToTradingServicesCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trading_services_customers', function (Blueprint $table) {
            $table->string('customer_agency_email')->nullable()
                ->after('customer_agency_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trading_services_customers', function (Blueprint $table) {
            $table->dropColumn('customer_agency_email');
        });
    }
}
