<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColsFeeColsToDepositAgencyCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table('deposit_agency_countries',function (Blueprint $table){
            $table->decimal('fee_percent',5,2)
                ->after('ytadawul_account_number')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table('deposit_agency_countries',function (Blueprint $table){
            $table->dropColumn('fee_percent');
        });
    }
}
