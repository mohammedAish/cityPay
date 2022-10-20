<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrgPrivacyPoliciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('org_privacy_policies', function (Blueprint $table) {
            $table->id();
            $table->longText('public_information');
            $table->longText('access_for_data');
            $table->longText('manage_personal_data');
            $table->longText('information_collect');
            $table->longText('how_Uses_data');
            $table->longText('sharing_data');
            $table->longText('For_inquiries');

            $table->longText('public_information_en');
            $table->longText('access_for_data_en');
            $table->longText('manage_personal_data_en');
            $table->longText('information_collect_en');
            $table->longText('how_Uses_data_en');
            $table->longText('sharing_data_en');
            $table->longText('For_inquiries_en');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('org_privacy_policies');
    }
}
