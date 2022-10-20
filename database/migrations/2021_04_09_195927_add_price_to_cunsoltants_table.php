<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPriceToCunsoltantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table('consultants',function (Blueprint $table){
            $table->decimal('price',13,2)->default(0)->nullable()->after('consultant_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table('consultants',function (Blueprint $table){
            $table->dropColumn('price');
        });
    }
}
