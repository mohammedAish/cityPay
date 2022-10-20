<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnsToCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->tinyInteger('confirmation_notification')->nullable()->default(0)->after('is_verified');
            $table->tinyInteger('confirmation_method')->nullable()->default(0)->after('confirmation_notification');
            $table->tinyInteger('is_master_key_enabled')->nullable()->default(0)->after('confirmation_method');
            $table->string('master_key', 10)->nullable()->after('is_master_key_enabled');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            //
        });
    }
}
