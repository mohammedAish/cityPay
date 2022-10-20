<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDigitalCardsPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('digital_cards_purchases',function (Blueprint $table){
            $table->id();
            $table->timestamp('purchase_date')->nullable();
            //Deprecated we will not record it any more
            $table->string('credit_account_number')->nullable()
                ->default(config('ytadawul.accounting.account_numbers.center_fund',0));
            $table->decimal('total_invoice',13,2)->default(0);
            $table->unsignedBigInteger('currency_id');
            $table->foreign('currency_id')->references('id')
                ->on('currencies');
            $table->text('description')->nullable();
            $table->string('reference_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('purchases_digital_cards');
    }
}
