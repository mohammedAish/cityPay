<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('customers',function (Blueprint $table){
            $table->id();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone2')->nullable();
            $table->enum('gender',['F','M']);
            $table->date('birth_date')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id')->references('id')
                ->on('cities')->onDelete('set null')->onUpdate('set null');
            $table->text('address')->nullable();
            $table->text('address_2')->nullable();
            $table->string('account_number')->unique()->nullable()
                ->comment('that related with wallet account');
            $table->enum('customer_type',['customer','per_consultant','consultant',])->default('customer');
            $table->boolean('active')->default(1);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('customers');
    }
}
