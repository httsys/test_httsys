<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddGameOptionsAndTradeFields extends Migration
{
    public function up()
    {
        if (Schema::hasTable("game_settings")) {
            if (! Schema::hasColumn("game_settings", "win_block")) {
                Schema::table("game_settings", function (Blueprint $table) {
                    // "win_percent" wins out of every "win_block" plays (100 = the old percentage meaning)
                    $table->unsignedSmallInteger("win_block")->default(100);
                });
            }
            if (! Schema::hasColumn("game_settings", "options")) {
                Schema::table("game_settings", function (Blueprint $table) {
                    // game specific settings (JSON): slot prizes, trade min/max stake and payout
                    $table->text("options")->nullable();
                });
            }
        }

        if (Schema::hasTable("game_plays")) {
            if (! Schema::hasColumn("game_plays", "stake")) {
                Schema::table("game_plays", function (Blueprint $table) {
                    $table->unsignedInteger("stake")->default(0);          // trade game: points the player put in
                });
            }
            if (! Schema::hasColumn("game_plays", "direction")) {
                Schema::table("game_plays", function (Blueprint $table) {
                    $table->string("direction", 10)->nullable();           // trade game: up | down
                });
            }
            if (! Schema::hasColumn("game_plays", "trade_seconds")) {
                Schema::table("game_plays", function (Blueprint $table) {
                    $table->unsignedSmallInteger("trade_seconds")->nullable(); // trade game: 10 | 30 | 60 | 300
                });
            }
            if (! Schema::hasColumn("game_plays", "points_change")) {
                Schema::table("game_plays", function (Blueprint $table) {
                    $table->integer("points_change")->default(0);          // net points added (+) or taken (-)
                });

                DB::table("game_plays")
                    ->where("points_awarded", ">", 0)
                    ->update(["points_change" => DB::raw("points_awarded")]);
            }
        }
    }

    public function down()
    {
        foreach (["stake", "direction", "trade_seconds", "points_change"] as $column) {
            if (Schema::hasTable("game_plays") && Schema::hasColumn("game_plays", $column)) {
                Schema::table("game_plays", function (Blueprint $table) use ($column) {
                    $table->dropColumn($column);
                });
            }
        }
        foreach (["win_block", "options"] as $column) {
            if (Schema::hasTable("game_settings") && Schema::hasColumn("game_settings", $column)) {
                Schema::table("game_settings", function (Blueprint $table) use ($column) {
                    $table->dropColumn($column);
                });
            }
        }
    }
}
