<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmailVerificationEnabledToSettingsTable extends Migration
{
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            // Off by default so an existing live site doesn't suddenly start
            // requiring verification codes before SMTP is confirmed working.
            $table->boolean('email_verification_enabled')->default(0)->after('ticker_status');
        });
    }

    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('email_verification_enabled');
        });
    }
}
