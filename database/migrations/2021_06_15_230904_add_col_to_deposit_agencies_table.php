<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColToDepositAgenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table('deposit_agencies',function (Blueprint $table){
            $table->boolean('is_withdraw_agency')->default(1)
                ->after('national')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table('deposit_agencies',function (Blueprint $table){
            $table->dropColumn('is_withdraw_agency');
        });
    }
}
