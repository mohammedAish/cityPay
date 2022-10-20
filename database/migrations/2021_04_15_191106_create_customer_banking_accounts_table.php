<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerBankingAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('customer_banking_accounts',function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')
                ->on('customers');
            $table->string('account_number');
            $table->enum('account_type',['cash','wallet'])->default('cash');
            $table->unsignedBigInteger('receiving_agencies_country_id');
            $table->foreign('receiving_agencies_country_id')->references('id')
                ->on('receiving_agencies_countries');
            $table->string('country_code')->nullable();
            $table->foreign('country_code')
                ->references('code')->on('countries');
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->foreign('currency_id')->references('id')
                ->on('currencies');
            $table->unique(['account_number','receiving_agencies_country_id'],'account_number_unique');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('customer_banking_accounts');
    }
}
