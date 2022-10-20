<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCutomerFinanceAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('customer_finance_accounts',function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')
                ->on('customers');
            $table->unsignedBigInteger('agency_id')->nullable();
            $table->foreign('agency_id','cutomer_finance_accounts_agency_id_foreign')->references('id')
                ->on('deposit_agencies');
            $table->string('customer_agency_acc_number')->nullable();
            $table->unique(['customer_id','agency_id','customer_agency_acc_number'],
                'unique_number_acc_customers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('customer_finance_accounts');
    }
}
