<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSliderAutoplaySecondsToSettingsTable extends Migration
{
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            // Matches the site's previous hardcoded 8000ms default.
            $table->unsignedSmallInteger('slider_autoplay_seconds')->default(8)->after('email_verification_enabled');
        });
    }

    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('slider_autoplay_seconds');
        });
    }
}
