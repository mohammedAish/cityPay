<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        //قد يكون هناك درس له مرفقات وهذة المرفقات قد تكون فيديو او نص او صور

        Schema::create('subject_attachments',function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('subject_id')->nullable();
            $table->foreign('subject_id')->references('id')
                ->on('course_subjects')->onUpdate('cascade')
                ->onDelete('cascade');
            $table->mediumText('name');
            $table->mediumText('subject_path');
            $table->text('description')->nullable();
            $table->enum('subject_type',['video','file','image'])
                ->default('video');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('subject_attachments');
    }
}
