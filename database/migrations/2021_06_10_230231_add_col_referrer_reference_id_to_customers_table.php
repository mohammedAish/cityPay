<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColReferrerReferenceIdToCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table('customers',function (Blueprint $table){
            $table->string('reference_id')->nullable()->unique()
                ->after('badge_id');
            $table->string('referrer')->nullable()
                ->after('reference_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table('customers',function (Blueprint $table){
            $table->dropColumn(['reference_id','referrer']);
        });
    }
}
