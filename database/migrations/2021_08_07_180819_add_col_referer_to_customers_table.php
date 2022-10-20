<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColRefererToCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
           $table->dropColumn('referrer');
            $table->string('referrer_id')->nullable()->after('wallet_code')
            ->comment('who the refer for this customer for registration');
            $table->unsignedInteger('count_rer_ops')->nullable()->default(0)->after('referrer_id')
                ->comment('mean that the count of ops which get the referer as comms from this customer');
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
            $table->string('referrer')->nullable()->after('reference_id');
            $table->dropColumn(['referrer_id','count_rer_ops']);
        });
    }
}
