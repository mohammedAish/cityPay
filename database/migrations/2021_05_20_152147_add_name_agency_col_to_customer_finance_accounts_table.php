<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNameAgencyColToCustomerFinanceAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table('customer_finance_accounts',function (Blueprint $table){
            $table->string('agency_name')->nullable()
                ->after('agency_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table('customer_finance_accounts',function (Blueprint $table){
            $table->dropColumn('agency_name');
        });
    }
}
