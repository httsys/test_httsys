<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPhotoDarkIdToSettingsTable extends Migration
{
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('photo_dark_id')->nullable()->after('photo_id');
        });
    }

    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('photo_dark_id');
        });
    }
}
