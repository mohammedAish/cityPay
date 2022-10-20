<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('course_subjects',function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('id')
                ->on('courses_trainings');
            $table->unsignedBigInteger('part_id')->nullable();
            $table->foreign('part_id')->references('id')
                ->on('course_parts');
            $table->integer('sort')->default(0)->nullable();
            $table->mediumText('name');
            $table->mediumText('subject_path');
            $table->text('description')->nullable();
            $table->enum('subject_type',['video','file','image'])
                ->default('video');
            $table->decimal('kb_volume',8,2)->comment('in kilobyte');
            $table->integer('duration')->nullable()->comment('by minutes');
            $table->boolean('is_free')->default(0)->nullable();
            //extra cols
            $table->unsignedInteger('visited')->default(0)->nullable();
            $table->unsignedInteger('likes')->default(0)->nullable();
            $table->unsignedInteger('dis_likes')->default(0)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('course_subjects');
    }
}
