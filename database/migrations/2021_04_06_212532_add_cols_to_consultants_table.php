<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColsToConsultantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table('consultants',function (Blueprint $table){
            $table->text('who_will_benefit')->after('description')->nullable();
            $table->text('what_will_benefit')->after('who_will_benefit')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table('consultants',function (Blueprint $table){
            $table->dropColumn('who_will_benefit','what_will_benefit');
        });
    }
}
