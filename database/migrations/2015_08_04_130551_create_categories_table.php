<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriesTable extends Migration
{
    /**
     * @return void
     * @deprecated
     * created by lara backpack
     * Run the migrations.
     *
     */
    public function up(){
        Schema::create('categories',function (Blueprint $table){
            $table->increments('id');
            $table->integer('parent_id')->default(0)->nullable();
            $table->integer('lft')->unsigned()->nullable();
            $table->integer('rgt')->unsigned()->nullable();
            $table->integer('depth')->unsigned()->nullable();
            $table->string('name',1000);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::drop('categories');
    }
}
