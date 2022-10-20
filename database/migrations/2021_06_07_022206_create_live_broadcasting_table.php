<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiveBroadcastingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::dropIfExists('live_tradings');
        Schema::create('live_broadcasting',function (Blueprint $table){
            $table->id();
            $table->string('subject',1000);
            $table->mediumText('description')->nullable();
            $table->mediumText('img_path')->nullable();
            $table->dateTime('start_at')->nullable();
            $table->dateTime('end_at')->nullable();
            $table->mediumText('sharing_link')->nullable()->comment('zoom,gmeet,..');
            $table->mediumText('external_link')->nullable()
                ->comment('after complete maybe share it on youtube');;//if available lastly on youtube example
            $table->string('author')->nullable();                      //المتحدث
            $table->boolean('commentable')->default(0);

            $table->decimal('rating')->nullable()->default(5);
            $table->boolean('active_now')->default(0);
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
        Schema::dropIfExists('live_broadcasting');
    }
}
