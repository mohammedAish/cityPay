<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('accounts_groups',function (Blueprint $table){
            $table->id('id');
            $table->unsignedBigInteger('parent_group');
            //@TODO Caution you cant add ->onDelete('cascade')->onUpdate('cascade')
            //because there are accounts that have transaction
            //make logic code to check when delete
            $table->foreign('parent_group')->references('id')
                ->on('accounts_groups');
            $table->string('group_code',50)->unique();
            $table->string('group_name',100);
            $table->string('group_name_en',100);
            $table->text('description')->nullable();
            $table->boolean('can_edited')->nullable()->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('accounts_groups');
    }
}
