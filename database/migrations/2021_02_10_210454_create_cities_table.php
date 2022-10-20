<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->string('name_en',100);
            $table->string('country_code')->nullable();
            $table->foreign('country_code')
                ->references('code')->on('countries')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->decimal('latitude',11,8)->nullable();
            $table->decimal('longitude',11,8)->nullable();
          //  $table->string('subadmin1_code');
            $table->string('timezone')->nullable();
            $table->boolean('active')->default(1);
            $table->unique(['name','country_code'],'idx_name_city_country_code_unique');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cities');
    }
}
