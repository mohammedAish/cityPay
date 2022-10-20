<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDepositTypeToDepositMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deposit_methods', function (Blueprint $table) {
       $table->enum('deposit_type',config('ytadawul.accounting.deposit_types'))
           ->default('cash')->after('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deposit_methods', function (Blueprint $table) {
            $table->dropColumn('deposit_type');
        });
    }
}
