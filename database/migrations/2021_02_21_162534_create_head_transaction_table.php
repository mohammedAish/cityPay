<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateHeadTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('head_transaction',function (Blueprint $table){
            $table->id('id');
            $table->unsignedBigInteger('voucher_id')->unique();
            $table->enum('voucher_type',['journal','receipt','payment','equation'])
                ->default('journal');
            $table->decimal('total_voucher',13,2)
                ->comment('in USD');
            $table->timestamp('voucher_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->text('detailed_statement')->nullable();
            $table->string('reference_id',50)->nullable()->comment('when typed from user ');
            $table->string('reference_type',50)->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_simple')->default(1)->nullable();
            $table->boolean('auto_created')->default(1)->nullable();
            $table->boolean('is_deported')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('head_transaction');
    }
}
