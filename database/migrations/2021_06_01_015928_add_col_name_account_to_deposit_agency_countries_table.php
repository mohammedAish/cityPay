<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColNameAccountToDepositAgencyCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deposit_agency_countries', function (Blueprint $table) {
            $table->string('ytadawul_account_name')->nullable()
                ->after('ytadawul_account_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deposit_agency_countries', function (Blueprint $table) {
            $table->dropColumn('ytadawul_account_name');
        });
    }
}
