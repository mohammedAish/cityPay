<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColToDepositAgencyCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table('deposit_agency_countries',function (Blueprint $table){
            $table->decimal('withdraw_fee_percent',5,2)->nullable()->after('fee_percent')
                ->default(1)
                ->comment('when the agency is agency for withdraw too');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table('deposit_agency_countries',function (Blueprint $table){
            $table->dropColumn('withdraw_fee_percent');
        });
    }
}
