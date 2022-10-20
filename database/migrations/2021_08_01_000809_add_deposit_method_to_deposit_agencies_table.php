<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDepositMethodToDepositAgenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('deposit_agencies', function (Blueprint $table) {
            $table->unsignedBigInteger('deposit_method_id')->nullable()
                ->after('name');
            $table->foreign('deposit_method_id', 'deposit_agency_method_FK')
                ->on('deposit_methods')
                ->references('id')
                ->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('deposit_agencies', function (Blueprint $table) {
            $table->dropForeign('deposit_agency_method_FK');
            $table->dropColumn('deposit_method_id');

        });
    }
}
