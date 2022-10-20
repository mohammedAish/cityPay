<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceivingTransferMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        //
        Schema::create('receiving_agencies_countries',function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('country_id');
            $table->foreign('country_id')->references('id')
                ->on('countries');
            $table->unsignedBigInteger('transfer_agency_id');
            $table->foreign('transfer_agency_id')->references('id')
                ->on('transfer_agencies');
            $table->decimal('transfer_fee',5,2)->default(0.01)->nullable()
                ->comment(' transfer percent will count over the amount of transferred money and must be less then 100 ');
            $table->text('description')->nullable()
                ->comment('explain how the fees counted');
            $table->unique(['country_id','transfer_agency_id'],'idx_country_id_transfer_agency_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('receiving_transfer_methods');
    }
}
