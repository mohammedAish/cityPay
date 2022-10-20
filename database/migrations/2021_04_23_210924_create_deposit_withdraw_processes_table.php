<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositWithdrawProcessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('deposit_withdraw_processes',function (Blueprint $table){
            $table->id();
            $table->morphs('processable');
            //it will be deposit_order_id or transfer_order_id
            $table->string('transfer_number')->nullable();
            $table->string('reference_id_type')->nullable();
            $table->unsignedBigInteger('admin_id')->nullable()
                ->comment('who confirmed this op');
            $table->foreign('admin_id')->references('id')
                ->on('users')->onUpdate('cascade');
            $table->text('admin_note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('deposit_withdraw_processes');
    }
}
