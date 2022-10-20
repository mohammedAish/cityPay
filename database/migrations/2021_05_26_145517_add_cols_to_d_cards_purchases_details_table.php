<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColsToDCardsPurchasesDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table('d_cards_purchases_details',function (Blueprint $table){
            $table->string('card_code')->after('digital_card_id')->nullable()
                ->comment('when order accept and admin will put code here')->change();
            $table->renameColumn('price',"buy_price");
            $table->decimal('sell_price',13,2)
                ->nullable()->after('expire_date');
            $table->unsignedBigInteger('currency_id')->after('sell_price')->nullable();
            $table->foreign('currency_id')->references('id')
                ->on('currencies');
            $table->foreign('customer_d_c_order_id')->references('id')
                ->on('customer_d_c_orders');
            $table->text('description')->after('assign_date')
                ->comment('instruction about using')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table('d_cards_purchases_details',function (Blueprint $table){
            //
        });
    }
}
