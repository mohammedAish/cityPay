<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrgNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('org_news',function (Blueprint $table){
            $table->id();
            $table->string('new_title');
            $table->string('new_subtitle');
            $table->string('slug');
            $table->string('short_link');
            $table->text('keywords');
            $table->bigInteger('views');
            $table->string('new_image')->nullable();
            $table->longText('new_content');
            $table->enum('language',['ar','en'])->default('ar');
            $table->bigInteger('original_row')->nullable();
            $table->boolean('translated')->default(false);
            $table->bigInteger('translated_id')->nullable();
            $table->biginteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('org_news');
    }
}
