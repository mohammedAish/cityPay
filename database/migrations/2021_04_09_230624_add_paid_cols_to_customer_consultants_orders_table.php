<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaidColsToCustomerConsultantsOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table('customer_consultants_orders',function (Blueprint $table){
            $table->enum('paid_status',['not_paid','paid','part_paid'])->default('not_paid')
            ->after('current_status');
            $table->string('reference_id_type')->nullable()->after('paid_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table('customer_consultants_orders',function (Blueprint $table){
            $table->dropColumn(['paid_status','reference_id_type']);
        });
    }
}
