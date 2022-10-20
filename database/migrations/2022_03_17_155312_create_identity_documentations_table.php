<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdentityDocumentationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('identity_documentations', function (Blueprint $table) {
            $table->id();
//            $table->string('first_name')->nullable();
//            $table->string('last_name')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->string('first_name_en')->nullable();
            $table->string('last_name_en')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            
            $table->string('document_type')->nullable();
            $table->string('document_file')->nullable();
            $table->text('manager_address')->nullable();

            $table->integer('country_id')->nullable();
//            $table->foreign('country_id')
//                ->references('id')->on('countries');
            
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')->references('id')
                ->on('customers');
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
        Schema::dropIfExists('identity_documentations');
    }
}
