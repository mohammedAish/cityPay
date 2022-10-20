<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLanCodeToFrontendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('frontends', function (Blueprint $table) {
            $table->enum('lang_code',['ar','en'])->default('ar')
            ->after('data_keys');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('frontends', function (Blueprint $table) {
            $table->dropColumn('lang_code');
        });
    }
}
