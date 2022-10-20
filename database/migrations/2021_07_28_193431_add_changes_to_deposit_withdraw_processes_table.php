<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChangesToDepositWithdrawProcessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deposit_withdraw_processes', function (Blueprint $table) {
            $table->text('old_values')->nullable()->after('reference_id_type');
            $table->text('new_values')->nullable()->after('reference_id_type');
            $table->enum('last_modified_by', ['customer', 'admin'])->default('admin')
                ->after('reference_id_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deposit_withdraw_processes', function (Blueprint $table) {
            $table->dropColumn(['changes','last_modified_by']);
        });
    }
}
