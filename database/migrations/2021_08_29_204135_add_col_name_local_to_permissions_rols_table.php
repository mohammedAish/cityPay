<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColNameLocalToPermissionsRolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $rolesTable=  config('permission.table_names.roles');
        $permissionsTable=  config('permission.table_names.permissions');
        Schema::table($rolesTable, function (Blueprint $table) {
            $table->string('name_desc',1000)->nullable()->after('name');
        });
        Schema::table($permissionsTable, function (Blueprint $table) {
            $table->string('name_desc',1000)->nullable()->after('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $rolesTable=  config('permission.table_names.roles');
        $permissionsTable=  config('permission.table_names.permissions');
        Schema::table($rolesTable, function (Blueprint $table) {
            $table->dropColumn('name_desc');
        }); Schema::table($permissionsTable, function (Blueprint $table) {
            $table->dropColumn('name_desc');
        });
    }
}
