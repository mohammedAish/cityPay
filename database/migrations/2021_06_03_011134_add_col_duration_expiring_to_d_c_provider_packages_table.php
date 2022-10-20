<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColDurationExpiringToDCProviderPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('d_c_provider_packages', function (Blueprint $table) {
            $table->unsignedInteger('expire_days')->nullable()
                ->after('currency_id')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('d_c_provider_packages', function (Blueprint $table) {
            $table->dropColumn('expire_days');
        });
    }
}
