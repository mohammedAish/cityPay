<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCurrentStatusToCustomerConsultantsOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table('customer_consultants_orders',function (Blueprint $table){
            $table->enum('current_status',
                ['pending','processing','succeed','rejected'])->after('is_open')
            ->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table('customer_consultants_order',function (Blueprint $table){
            $table->dropColumn('current_status');
        });
    }
}
