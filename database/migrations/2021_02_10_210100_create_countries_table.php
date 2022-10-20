<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('countries',function (Blueprint $table){
            $table->id();
            $table->string('code')->unique();
            $table->string('name',100);
            $table->string('name_en',100);
            $table->boolean('is_source_transferring')->default(0)
                ->comment('is this country a source in transfer by YtadawulPay');
            $table->boolean('is_dist_transferring')->default(0)
                ->comment('is this country a destination place in transfer by YtadawulPay');
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->foreign('currency_id')->references('id')->on('currencies')
                ->onDelete('set null')->onUpdate('set null');
            $table->text('img_path')->nullable()
            ->comment('the map path');
            $table->text('flag_path')->nullable();
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
        Schema::dropIfExists('countries');
    }
}
