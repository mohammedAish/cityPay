<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrencyChangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('currency_changes',function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('admin_id')
                ->comment('who did this changes');
            $table->foreign('admin_id')->references('id')->on('users');
            $table->unsignedBigInteger('currency_id');
            $table->foreign('currency_id')->references('id')->on('currencies');
            $table->timestamp('from_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('to_date')->nullable();
            $table->decimal('currency_value',13,2)
                ->comment('value for this currency per USD in this duration');
            $table->boolean('is_current_value')->nullable()->default(0);
            $table->text('description')->nullable()->comment('why this changes accrue');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('currency_changes');
    }
}
