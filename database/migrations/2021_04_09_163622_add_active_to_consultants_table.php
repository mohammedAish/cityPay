<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddActiveToConsultantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table('consultants',function (Blueprint $table){
            $table->boolean('active')->default(1)->after('external_link');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table('consultants',function (Blueprint $table){
            $table->dropColumn('active');
        });
    }
}
