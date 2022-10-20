<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColPayingTimeToPayingOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table('paying_orders',function (Blueprint $table){
            $table->dateTime('paying_date')->nullable()->after('product_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table('paying_orders',function (Blueprint $table){
            $table->dropColumn('paying_date');
        });
    }
}
