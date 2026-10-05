<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameSettingsTable extends Migration
{
    public function up()
    {
        if (Schema::hasTable("game_settings")) {
            return;
        }

        Schema::create("game_settings", function (Blueprint $table) {
            $table->id();
            $table->string("game_key", 50)->unique(); // spin_wheel | flip_coin
            $table->string("name");
            $table->unsignedTinyInteger("win_percent")->default(30); // 0-100: wins per 100 plays
            $table->unsignedInteger("hourly_limit")->default(10); // plays allowed per user per rolling hour, 0 = unlimited
            $table->unsignedInteger("points_per_win")->default(1);
            $table->boolean("is_active")->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists("game_settings");
    }
}
