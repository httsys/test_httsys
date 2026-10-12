<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tic Tac Toe matches (vs computer and online rooms).
 *
 * Safe to run twice: it does nothing when the table already exists.
 * Nothing else is touched - points and history still use game_plays / users.points.
 */
class CreateTictactoeMatchesTable extends Migration
{
    public function up()
    {
        if (Schema::hasTable('tictactoe_matches')) {
            return;
        }

        Schema::create('tictactoe_matches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 8)->nullable();                 // share code of an online room
            $table->string('mode', 10);                            // ai | online
            $table->unsignedTinyInteger('size');                   // 3 | 5 | 7
            $table->unsignedTinyInteger('win_len');                // symbols in a row needed
            $table->string('board', 49);                           // one char per cell: - X O
            $table->char('turn', 1)->default('X');
            $table->string('status', 10)->default('waiting');      // waiting | active | finished | cancelled
            $table->string('winner', 4)->nullable();               // X | O | draw
            $table->string('win_cells', 120)->nullable();          // "0,1,2" cells of the winning line
            $table->string('end_reason', 12)->nullable();          // line | draw | left | timeout
            $table->smallInteger('last_cell')->nullable();
            $table->unsignedBigInteger('x_user_id');
            $table->unsignedBigInteger('o_user_id')->nullable();   // null for vs-computer
            $table->unsignedBigInteger('x_play_id')->nullable();   // game_plays row of X
            $table->unsignedBigInteger('o_play_id')->nullable();   // game_plays row of O
            $table->string('x_ip', 45)->nullable();
            $table->string('o_ip', 45)->nullable();
            $table->unsignedInteger('points_awarded')->default(0);
            $table->timestamp('last_move_at')->nullable();
            $table->timestamps();

            $table->index('code', 'ttt_code_idx');
            $table->index(['x_user_id', 'status'], 'ttt_x_user_status_idx');
            $table->index(['o_user_id', 'status'], 'ttt_o_user_status_idx');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tictactoe_matches');
    }
}
