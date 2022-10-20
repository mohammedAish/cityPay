<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsOpenToCustomerSPOpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        //if the customer op is open then he can use the related service
        Schema::table('customer_s_p_ops',function (Blueprint $table){
            $table->boolean('is_open')->default(1)
                ->after('current_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table('customer_s_p_ops',function (Blueprint $table){
            $table->dropColumn('is_open');
        });
    }
}
