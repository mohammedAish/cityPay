<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrgServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('org_services', function (Blueprint $table) {
            $table->id();
            $table->text('service_title');
            $table->longText('service_sub_title');

            $table->string('service_background');
            $table->enum('language',['ar','en'])->default('ar');
            $table->bigInteger('original_row')->nullable();
            $table->boolean('translated')->default(false);
            $table->bigInteger('translated_id')->nullable();
            $table->longText('service_short_desc_title');
            $table->longText('service_short_desc');
            $table->longText('service_desc');
            $table->string('slug');
            $table->text('service_icons')->nullable();
            $table->string('login_title');
            $table->longText('login_desc');

            $table->text('service_keyword');
            $table->biginteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->biginteger('service_category_id')->unsigned();
            $table->foreign('service_category_id')->references('id')
                ->on('org_service_categories')->onDelete('cascade');

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
        Schema::dropIfExists('org_services');
    }
}
