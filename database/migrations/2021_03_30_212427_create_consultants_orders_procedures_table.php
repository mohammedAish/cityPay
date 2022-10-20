<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultantsOrdersProceduresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('consultants_orders_procedures',function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('consultants_order_id');
            $table->foreign('consultants_order_id')->references('id')
                ->on('customer_consultants_orders');
            $table->unsignedBigInteger('procedure_type_id')->nullable();
            $table->foreign('procedure_type_id')->references('id')
                ->on('procedure_types');
            $table->text('process_description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('consultants_orders_processes');
    }
}
