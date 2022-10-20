<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTreeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('accounts_tree',function (Blueprint $table){
            $table->id('id');
            $table->string('account_number',50)->unique();
            $table->string('account_name',191)->unique();
            $table->string('account_name_en',191)->nullable();
            $table->string('acc_group_code',50);
            //because there are accounts that have transaction
            //make logic code to check when delete
            $table->foreign('acc_group_code')
                ->references('group_code')->on('accounts_groups');
            $table->enum('balance_type',['cr','dr'])
                ->default('dr')->comment('cr =credit,dr=debit');
            $table->decimal('opening_balance',13,2)->nullable()->default(0);
            $table->decimal('current_balance',13,2)->nullable()->default(0);
            $table->boolean('is_bank_cash')->nullable()->default(0);
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('accounts_tree');
    }
}
