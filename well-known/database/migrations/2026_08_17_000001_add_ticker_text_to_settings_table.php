<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTickerTextToSettingsTable extends Migration
{
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->text('ticker_text')->nullable()->after('maintenance_text');
            $table->boolean('ticker_status')->default(0)->after('ticker_text');
        });
    }

    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['ticker_text', 'ticker_status']);
        });
    }
}
