<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColLastModifiedByToPayingOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('paying_orders', function (Blueprint $table) {
            $table->enum('last_edited_by',['customer','admin'])->default('customer')
                ->after('current_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('paying_orders', function (Blueprint $table) {
            $table->dropColumn('last_edited_by');
        });
    }
}
