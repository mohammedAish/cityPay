<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiveTradingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('live_tradings',function (Blueprint $table){
            $table->id();
            $table->string('trader_name')->nullable();
            $table->string('trading_code')->nullable();
            $table->text('live_subject')->nullable();
            $table->text('description')->nullable();
            $table->timestamp('start_time')->nullable();
            $table->integer('duration')->unsigned()->comment('in minutes');
            $table->text('sharing_link')->nullable()->comment('zoom,gmeet,..');
            $table->text('external_link')->nullable()->comment('after complete maybe share it on youtube');
            //if commentable then show the comments
            $table->boolean('commentable')->default(0);
            $table->boolean('active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('live_tradings');
    }
}
