<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColToLoyaltyPointsPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loyalty_points_prices', function (Blueprint $table) {
            $table->unsignedBigInteger('badge_id')->nullable()
                ->after('to');
            $table->foreign('badge_id','loyalty_points_badge_fk')
                ->references('id')->on('badges');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('loyalty_points_prices', function (Blueprint $table) {
            $table->dropForeign('loyalty_points_badge_fk');
            $table->dropColumn('badge_id');
        });
    }
}
