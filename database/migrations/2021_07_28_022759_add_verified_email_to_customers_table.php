<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVerifiedEmailToCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('customers', function (Blueprint $table) {
            $table->tinyInteger('verified_email', false, true)
                ->after('email_verified_at')
                ->nullable()->default(0);
            $table->string('email_token', 100)
                ->after('verified_email')
                ->nullable();
            $table->string('phone_token', 100)
                ->after('email_token')
                ->nullable();
            $table->tinyInteger('verified_phone', false, true)
                ->nullable()->after('verified_email')
                ->default(0);
            $table->tinyInteger('blocked', false, true)
                ->nullable()->after('active')
                ->default(0);
            $table->string('ip_addr')
                ->nullable()->after('blocked');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn(['verified_email', 'verified_phone', 'blocked', 'ip_addr','phone_token','email_token']);
        });
    }
}
