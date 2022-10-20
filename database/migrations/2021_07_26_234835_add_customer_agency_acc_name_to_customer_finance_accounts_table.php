<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCustomerAgencyAccNameToCustomerFinanceAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_finance_accounts', function (Blueprint $table) {
            $table->string('customer_agency_acc_name')->nullable()
                ->after('customer_agency_acc_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_finance_accounts', function (Blueprint $table) {
            $table->dropColumn('customer_agency_acc_name');

        });
    }
}
