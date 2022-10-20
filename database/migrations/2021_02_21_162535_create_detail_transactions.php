<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('detail_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('voucher_id')->unsigned();
            $table->foreign('voucher_id')
                ->references('voucher_id')
                ->on('head_transaction')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string('account_number', 50);
            //when delete father table must check here
            $table->foreign('account_number')
                ->references('account_number')->on('accounts_tree');
            $table->decimal('credit', 13, 4)->default(0);
            $table->decimal('debit', 13, 4)->default(0);
            $table->text('detailed_statement');
            $table->string('reference_id', 50)->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_transactions');
    }
}
