<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimezoneToSettingsTable extends Migration
{
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('timezone', 60)->default('Asia/Dhaka')->after('ip_language_detection_enabled');
        });
    }

    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('timezone');
        });
    }
}
