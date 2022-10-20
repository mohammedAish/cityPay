<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallet_transfers', function (Blueprint $table) {
            $table->id();
            $table->string('wallet_number')->nullable();
            $table->string('amount')->nullable();
            $table->string('fee')->nullable();
            $table->string('final_amount')->nullable();
            $table->string('currency')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')->references('id')
                ->on('customers');
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
        Schema::dropIfExists('wallet_transfers');
    }
}
