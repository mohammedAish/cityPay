<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColsToConsultantsCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table('consultants_categories',function (Blueprint $table){
            $table->text('img_path')->nullable()->after('name');
            $table->text('short_description')->after('img_path')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table('consultants_categories',function (Blueprint $table){
            $table->dropColumn('img_path','short_description');
        });
    }
}
