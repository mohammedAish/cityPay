<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCutomerFinanceAccToDepositOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deposit_orders', function (Blueprint $table) {
            $table->string('customer_finance_account')->nullable()->default(0)
                ->after('deposit_agency_country_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deposit_orders', function (Blueprint $table) {
            $table->dropColumn('customer_finance_account');
        });
    }
}
