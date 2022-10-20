<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCourseCategoryToCoursesTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table('courses_trainings',function (Blueprint $table){
            $table->unsignedBigInteger('course_category_id')->after('name');
            $table->foreign('course_category_id')->references('id')
                ->on('courses_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table('courses_trainings',function (Blueprint $table){
            $table->dropColumn('course_category_id');
        });
    }
}
