<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrgServiceCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('org_service_categories', function (Blueprint $table) {
            $table->id();
            $table->string('category_name');
            $table->text('category_desc');
            $table->string('category_icon');
            $table->string('category_keywords');
            $table->string('slug');
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
    public function down()
    {
        Schema::dropIfExists('org_service_categories');
    }
}
