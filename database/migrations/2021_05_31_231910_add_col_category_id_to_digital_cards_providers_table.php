<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColCategoryIdToDigitalCardsProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table('digital_cards_providers',function (Blueprint $table){
            $table->mediumText('short_desc')
                ->after('name')->nullable();
            $table->unsignedBigInteger('category_id')
                ->after('short_desc')->nullable();
            $table->foreign('category_id','digital_cards_providers_categoryFK')->references('id')
                ->on('digital_cards_categories');

            $table->string('back_ground_color1')->after('description')->nullable()->default();
            $table->string('back_ground_color2')->after('back_ground_color1')->nullable()->default();
            $table->dropColumn('img_path_en');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table('digital_cards_providers',function (Blueprint $table){
            $table->dropForeign('digital_cards_providers_categoryFK');
            $table->dropColumn(['category_id','back_ground_color1','back_ground_color2']);
        });
    }
}
