<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIpLanguageDetectionEnabledToSettingsTable extends Migration
{
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            // On by default, since this feature is already live — admin
            // can switch it off from the Settings page if they want the
            // site to always just use the normal default-language behavior
            // instead of checking the visitor's IP.
            $table->boolean('ip_language_detection_enabled')->default(1)->after('slider_autoplay_seconds');
        });
    }

    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('ip_language_detection_enabled');
        });
    }
}
