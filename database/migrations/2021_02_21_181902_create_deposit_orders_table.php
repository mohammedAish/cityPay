<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        //سيخزن الطلب هنا بالعملة التي طلبها العميل ولكن في محفظته سيتم احتساب سعر هذة العملة الى الدولار
        // ويخزن في جدول الحركات او جدول المحفظة دولار فقط
        Schema::create('deposit_orders',function (Blueprint $table){
            $table->id();
            $table->dateTime('deposit_date')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            //deprecated  ONLY DEPOSIT
            //THERE ARE NOT THING NAMED WITHDRAW
            //@todo BUT MAY BE THE INTERNAL WITHDRAW WILL BE HERE
            $table->enum('op_type',['deposit','withdraw'])->default('deposit')
                ->comment('is deposit or withdraw');
            $table->decimal('amount',13,2);
            $table->unsignedBigInteger('currency_id')->default(1);
            $table->foreign('currency_id')->references('id')->on('currencies')
                ->onUpdate('cascade');
            //سعر الصرف لهذة العملة نسبة الى سعر الدولار
            $table->decimal('exchange_price',11,2)->default(1)
                ->comment('the exchange price per USD in deposit moment ');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')->references('id')->on('customers')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->enum('deposit_type',array_values(config('ytadawul.accounting.deposit_types')))
                ->default('cash');
            //from where and what kind the order to deposit the
            $table->unsignedBigInteger('deposit_agency_country_id')->nullable();
            $table->foreign('deposit_agency_country_id')->references('id')
                ->on('deposit_agency_countries');
            $table->enum('current_status',['pending','rejected','confirmed'])
                ->default('pending');
            $table->text('status_note')->nullable()
                ->comment('when rejected or when still pending');
            $table->timestamp('status_changed_date')->nullable();
            //@todo why unique
            $table->unsignedBigInteger('confirmed_code')->unique()->nullable()
                ->comment('DEPRECATED the voucher id in transaction head or the deposit_id in wallet');
            $table->text('detail_statement')->nullable();
            $table->unsignedBigInteger('admin_id')->nullable()->comment('who confirmed this op');
            $table->foreign('admin_id')->references('id')->on('users')
                ->onUpdate('cascade');
            $table->text('img_path')->nullable();
            $table->string('reference_id')->nullable()
            ->comment('will be filled by customer and reviewed by admin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('deposit_orders');
    }
}
