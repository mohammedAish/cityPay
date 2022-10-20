<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateErrorReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('error_reports', function (Blueprint $table) {
            $table->id();
            $table->string('error_link')->nullable();
            $table->string('error_action')->nullable();
            $table->text('error_file')->nullable();
            $table->tinyInteger('status')->nullable()->default(0);
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
        Schema::dropIfExists('error_reports');
    }
}
