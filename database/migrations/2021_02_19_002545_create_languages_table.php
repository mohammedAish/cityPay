<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('languages',function (Blueprint $table){
            $table->id();
            $table->string('abbr',10);
            $table->string('locale',20)->nullable();
            $table->string('name',100);
            $table->string('local_name',20)->nullable();
            $table->string('flag',100)->nullable();
            $table->enum('direction',['ltr','rtl'])->nullable()->default('ltr');
            $table->string('date_format',100)->nullable();
            $table->string('datetime_format',100)->nullable();
            $table->boolean('active')->nullable()->default('1');
            $table->boolean('default')->nullable()->default('0');
            $table->integer('lft')->unsigned()->nullable();
            $table->integer('rgt')->unsigned()->nullable();
            $table->timestamps();
            $table->unique(["abbr"]);
            $table->index(["active"]);
            $table->index(["default"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('languages');
    }
}
