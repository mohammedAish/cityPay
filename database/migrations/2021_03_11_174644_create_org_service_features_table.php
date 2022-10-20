<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrgServiceFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('org_service_features',function (Blueprint $table){
            $table->id();
            $table->string('feature_title');
            $table->longText('feature_desc');
            $table->biginteger('service_id')->unsigned();
            $table->foreign('service_id')->references('id')
                ->on('org_services')->onDelete('cascade');
            $table->biginteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade');
            $table->enum('language',['ar','en'])->default('ar');
            $table->bigInteger('original_row')->nullable();
            $table->boolean('translated')->default(false);
            $table->bigInteger('translated_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('org_service_features');
    }
}
