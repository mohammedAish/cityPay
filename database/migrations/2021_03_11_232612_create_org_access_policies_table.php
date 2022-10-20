<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrgAccessPoliciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('org_access_policies', function (Blueprint $table) {
            $table->id();
            $table->longText('introduction');
            $table->longText('target');
            $table->longText('uses_website');
            $table->longText('included_website');
            $table->longText('subscribe_customer');
            $table->longText('Alternative_solutions');
            $table->longText('Compliance_standards');
            $table->string('phone');
            $table->string('whatsApp');
            $table->string('default_email');

            $table->longText('introduction_en');
            $table->longText('target_en');
            $table->longText('uses_website_en');
            $table->longText('included_website_en');
            $table->longText('subscribe_customer_en');
            $table->longText('Alternative_solutions_en');
            $table->longText('Compliance_standards_en');

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
        Schema::dropIfExists('org_access_policies');
    }
}
