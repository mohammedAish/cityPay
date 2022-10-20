<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnsToCustomerFinanceAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_finance_accounts', function (Blueprint $table) {
            $table->string('recipient_name')->nullable()->after('customer_agency_acc_name');
            $table->string('phone_number')->nullable()->after('recipient_name');
            $table->string('address')->nullable()->after('phone_number');
            $table->string('soft_bank')->nullable()->after('address');
            $table->string('wallet_number')->nullable()->after('soft_bank');
            $table->unsignedBigInteger('deposit_type')->nullable()->after('agency_id');
            $table->foreign('deposit_type')->references('id')->on('deposit_methods');
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
            //
        });
    }
}
