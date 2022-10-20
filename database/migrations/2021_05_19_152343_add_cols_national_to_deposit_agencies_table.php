<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColsNationalToDepositAgenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table('deposit_agencies',function (Blueprint $table){
            $table->enum('national',['national','international'])->default('national')
                ->after('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table('deposit_agencies',function (Blueprint $table){
            $table->dropColumn('national');
        });
    }
}
