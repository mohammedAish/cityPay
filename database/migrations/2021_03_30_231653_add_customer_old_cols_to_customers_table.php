<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCustomerOldColsToCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table('customers',function (Blueprint $table){
            $table->string('country_code')->nullable()->after('phone');
            $table->string('facebook_acc')->nullable()->after('phone');
            $table->string('whatsapp_acc')->nullable()->after('phone');
            $table->string('img_profile')->nullable()->after('phone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table('customers',function (Blueprint $table){
            $table->dropColumn('country_code','facebook_acc','whatsapp_acc','img_profile');
        });
    }
}
