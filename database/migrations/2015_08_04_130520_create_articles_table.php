<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArticlesTable extends Migration
{
    /**
     * @deprecated
     * created by lara backpack
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        //@todo this not needed
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->string('title');
            $table->string('slug')->default('');
            $table->text('content');
            $table->string('image')->nullable();
            $table->enum('status', ['PUBLISHED', 'DRAFT'])->default('PUBLISHED');
            $table->date('date');
            $table->boolean('featured')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('articles');
    }
}
