<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransferWithdrawOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('transfer_withdraw_orders',function (Blueprint $table){
            $table->id();
            $table->decimal('amount',13,2);
            $table->unsignedBigInteger('currency_id')->default(1);
            $table->foreign('currency_id')->references('id')
                ->on('currencies')->onUpdate('cascade');
            //سعر الصرف لهذة العملة نسبة الى سعر الدولار
            $table->decimal('exchange_price',11,2)->default(1)
                ->comment('the exchange price per USD in deposit moment ');
            $table->decimal('transfer_fee',13,2)->default(0);
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')->references('id')
                ->on('customers');
            //this changed by another migration patch
            $table->enum('transfer_type',['cash','wallet'])
                ->default('cash');
            //from where and what kind the order to deposit the
            $table->unsignedBigInteger('transfer_agency_country_id')->nullable();
            $table->foreign('transfer_agency_country_id')->references('id')
                ->on('receiving_agencies_countries');
            $table->enum('current_status',['pending','rejected','confirmed'])
                ->default('pending');
            $table->text('status_note')->nullable()
                ->comment('when rejected or when still pending');
            $table->timestamp('status_changed_date')->nullable();
            $table->text('detail_statement')->nullable();
            $table->unsignedBigInteger('admin_id')->nullable()
                ->comment('who confirmed this op');
            $table->foreign('admin_id')->references('id')
                ->on('users')->onUpdate('cascade');
            $table->text('img_path')->nullable();
            $table->string('reference_id_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('transfer_withdraw_order');
    }
}
