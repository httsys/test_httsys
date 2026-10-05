<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamePlaysTable extends Migration
{
    public function up()
    {
        if (Schema::hasTable('game_plays')) {
            return;
        }

        Schema::create('game_plays', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('game_key', 50);
            $table->unsignedBigInteger('ad_id')->nullable();
            $table->string('choice', 10)->nullable();   // coin game: heads | tails picked by the user
            $table->boolean('is_win')->default(0);      // decided by the server when the play starts, hidden until answered
            $table->string('outcome', 10)->nullable();  // coin game: side the coin lands on
            $table->unsignedSmallInteger('ad_duration')->default(30);
            $table->unsignedTinyInteger('math_a')->nullable();
            $table->unsignedTinyInteger('math_b')->nullable();
            $table->unsignedTinyInteger('math_attempts')->default(0);
            $table->timestamp('ad_loaded_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->string('status', 15)->default('pending'); // pending | completed
            $table->unsignedInteger('points_awarded')->default(0);
            $table->string('ip_address', 45)->nullable();
            $table->timestamps();

            $table->index(['user_id', 'game_key', 'created_at'], 'game_plays_user_game_created_idx');
        });
    }

    public function down()
    {
        Schema::dropIfExists('game_plays');
    }
}
