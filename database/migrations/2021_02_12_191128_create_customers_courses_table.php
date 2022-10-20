<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('customers_courses',function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('id')
                ->on('courses_trainings');
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')
                ->on('customers');
            $table->timestamp('joined_date');
            //extra cols
            $table->unsignedBigInteger('last_subject_id')->nullable()
                ->comment('the last subject that customer interact with');
            $table->foreign('last_subject_id')->references('id')
                ->on('course_subjects');
            $table->decimal('final_degree',5,2)->default(0)
                ->comment('that will get in course');
            $table->enum('level_result',['A','B','C','D'])->default('A');

            $table->text('customer_note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('customers_courses');
    }
}
