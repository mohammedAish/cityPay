<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColReceivingInfoToTransferWithdrawOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table('transfer_withdraw_orders',function (Blueprint $table){
            $table->string('receiver_name')->nullable()->after('reference_id_type');
            $table->string('receiver_acc_number')->nullable()->after('receiver_name');
            $table->string('receiver_phone')->nullable()->after('receiver_acc_number');
            $table->string('receiver_email')->nullable()->after('receiver_phone');
            $table->mediumText('receiver_address')->nullable()->after('receiver_email');
            $table->mediumText('receiver_other_info')->nullable()->after('receiver_address');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table('transfer_withdraw_orders',function (Blueprint $table){
            $table->dropColumn([
                'receiver_name','receiver_acc_number','receiver_phone','receiver_email','receiver_address'
                ,'receiver_other_info',
            ]);
        });
    }
}
