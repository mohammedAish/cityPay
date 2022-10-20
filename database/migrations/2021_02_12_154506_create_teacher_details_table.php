<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('teacher_details',function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')
                ->on('customers');
            $table->date('last_certificate')->nullable();
            $table->text('classification')->nullable();
            $table->decimal('scores',5,2)->comment('that has from university');
            $table->text('skills')->nullable();
            $table->decimal('rating',2,1)->default(4);
            $table->timestamp('join_date');
            $table->boolean('active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('tariners');
    }
}
