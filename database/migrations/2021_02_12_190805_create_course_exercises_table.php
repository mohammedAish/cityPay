<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseExercisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('course_exercises',function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('course_id')->nullable();
            $table->foreign('course_id')->references('id')
                ->on('courses_trainings');
            $table->unsignedBigInteger('part_id')->nullable();
            $table->foreign('part_id')->references('id')
                ->on('course_parts');
            $table->integer('sort')->default(0);
            $table->text('content')->nullable();
            $table->text('external_link')->nullable();
            $table->enum('subject_type',['Q','A'])
                ->default('Q')->comment('Question OR Answer');
            //extra
            $table->unsignedInteger('visited')->default(0)->nullable();
            $table->unsignedInteger('is_helpful')->default(0)->nullable();
            $table->unsignedInteger('is_not_helpful')->default(0)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('course_exercises');
    }
}
