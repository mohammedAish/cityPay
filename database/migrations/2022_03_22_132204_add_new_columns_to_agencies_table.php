<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnsToAgenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deposit_agencies', function (Blueprint $table) {
            $table->tinyInteger('is_automatic')->nullable()->default(0)->after('deposit_method_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deposit_agencies', function (Blueprint $table) {
            $table->dropColumn('is_automatic');
        });
    }
}
