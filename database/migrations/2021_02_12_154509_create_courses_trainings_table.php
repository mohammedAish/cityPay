<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('courses_trainings',function (Blueprint $table){
            $table->id();
            //the teacher
            $table->unsignedBigInteger('teacher_id');
            $table->foreign('teacher_id')->references('id')
                ->on('teacher_details');
            $table->string('name',3000);
            $table->enum('language',['ar','en'])->default('ar');
            $table->text('description')->nullable();
            $table->text('requirements')->nullable();
            $table->text('what_learn')->nullable();
            $table->text('img_path')->nullable();
            $table->decimal('price',11,2);
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->foreign('currency_id')->references('id')
                ->on('currencies');
            $table->decimal('discount',11,2);
            $table->enum('discount_type',['percent','amount'])->default('amount');
            //some courses offer link in other site
            $table->text('external_link')->nullable();
            $table->boolean('active')->default(1);
            $table->enum('level',['beginner','intermediate','advanced','all_levels'])
                ->default('all_levels');
            $table->integer('subjects_count')->nullable();
            $table->integer('duration')->nullable();
            $table->integer('total_students')->default(0)
                ->comment('who studies in this course');
            $table->decimal('rating',2,1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('courses_trainig');
    }
}
