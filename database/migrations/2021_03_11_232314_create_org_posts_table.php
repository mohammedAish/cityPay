<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrgPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('org_posts', function (Blueprint $table) {
            $table->id();
            $table->string('post_title');
            $table->string('post_subtitle');
            $table->string('author_post',50);
            $table->string('slug');
            $table->string('short_link');
            $table->text('keywords');
            $table->bigInteger('views');
            $table->string('post_image')->nullable();
            $table->longText('post_content');
            $table->enum('language',['ar','en'])->default('ar');
            $table->bigInteger('original_row')->nullable();
            $table->boolean('translated')->default(false);
            $table->bigInteger('translated_id')->nullable();
            $table->biginteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->biginteger('post_category_id')->unsigned();
            $table->foreign('post_category_id')->references('id')
                ->on('org_post_categories')->onDelete('cascade');

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
        Schema::dropIfExists('org_posts');
    }
}
