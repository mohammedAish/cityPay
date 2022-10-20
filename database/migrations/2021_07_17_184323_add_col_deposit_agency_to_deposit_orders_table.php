<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColDepositAgencyToDepositOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deposit_orders', function (Blueprint $table) {
            $table->unsignedBigInteger('agency_id')->nullable()->after('deposit_type');
            $table->foreign('agency_id','deposit_order_agency_FG')->references('id')
                ->on('deposit_agencies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deposit_orders', function (Blueprint $table) {
            $table->dropForeign('deposit_order_agency_FG');
            $table->dropColumn('agency_id');
        });
    }
}
