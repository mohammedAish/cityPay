<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColsToDepositAgenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table('deposit_agencies',function (Blueprint $table){
            $table->mediumText('img_path')->nullable()->after('description');
            $table->mediumText('address')->nullable()->after('img_path');
            $table->string('phone')->nullable()->after('address');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table('deposit_agencies',function (Blueprint $table){
            $table->dropColumn('address','phone','img_path');
        });
    }
}
