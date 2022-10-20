<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColsToDigitalCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table('digital_cards',function (Blueprint $table){
            //we must store this here because the changes with time
            $table->unsignedBigInteger('store_id')->after('provider_id');
            $table->foreign('store_id')
                ->references('id')->on('digital_card_stores');
            //but why the befor FK
            $table->unsignedBigInteger('d_c_package_id')->after('store_id');
            $table->foreign('d_c_package_id')
                ->references('id')->on('d_c_provider_packages');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table('digital_cards',function (Blueprint $table){
            $table->dropColumn(['store_id','d_c_package_id']);
           /*
            $table->text('description')->nullable();
            $table->text('img_path')->nullable();
            // $table->text('img_path_en')->nullable();
            $table->decimal('price',11,2)->default(0);
            $table->unsignedBigInteger('currency_id');
            $table->foreign('currency_id')->references('id')
                ->on('currencies');
            //->onDelete('cascade')->onUpdate('cascade');
            $table->decimal('discount',11,2)->default(0);
            $table->decimal('bound_value',11,2)->nullable()
                ->comment('amount or the value of card per to 1USD dollar');*/
        });
    }
}
