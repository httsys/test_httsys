<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdProgressToGamePlaysTable extends Migration
{
    public function up()
    {
        if (! Schema::hasTable("game_plays") || Schema::hasColumn("game_plays", "ad_progress")) {
            return;
        }

        Schema::table("game_plays", function (Blueprint $table) {
            // Seconds of the ad countdown the player has really watched (page visible + mouse on the page).
            $table->unsignedSmallInteger("ad_progress")->default(0);
        });
    }

    public function down()
    {
        if (Schema::hasTable("game_plays") && Schema::hasColumn("game_plays", "ad_progress")) {
            Schema::table("game_plays", function (Blueprint $table) {
                $table->dropColumn("ad_progress");
            });
        }
    }
}
