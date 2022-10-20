<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColToCustomerCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers_courses', function (Blueprint $table) {
            $table->json('completed_subjects')
                ->after('last_subject_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers_courses', function (Blueprint $table) {
            $table->dropColumn('completed_subjects');
        });
    }
}
