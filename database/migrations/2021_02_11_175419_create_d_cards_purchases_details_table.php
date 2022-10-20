<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDCardsPurchasesDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('d_cards_purchases_details',function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('digital_cards_purchase_id');
            $table->foreign('digital_cards_purchase_id')->references('id')
                ->on('digital_cards_purchases');
            $table->unsignedBigInteger('digital_card_id');
            $table->foreign('digital_card_id')->references('id')
                ->on('digital_cards');
            $table->decimal('price',13,2)->default(0);
            $table->string('card_code',191)->nullable()
                ->comment('maybe returned without selling');
            $table->timestamp('expire_date')->nullable();
            $table->unique(['digital_card_id','card_code'],'idx_digital_card_code');
            $table->enum('card_status',['free','used','expired'])
                ->default('free');

            //when sell it for customer we will save the order_number
            $table->unsignedBigInteger('customer_d_c_order_id')->nullable();
            $table->timestamp('assign_date')->nullable()
                ->comment('when the card assigned to the customer');
            $table->enum('assigned_type',['auto','by_admin'])->default('auto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('d_cards_purchases_details');
    }
}
