<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Online Tic Tac Toe is now played for points: the host chooses an amount,
 * both players put it in, and the winner takes the pot minus the admin's fee.
 *
 * Only adds columns to tictactoe_matches; safe to run twice.
 */
class AddStakeToTictactoeMatchesTable extends Migration
{
    public function up()
    {
        if (! Schema::hasTable('tictactoe_matches')) {
            return;
        }

        Schema::table('tictactoe_matches', function (Blueprint $table) {
            if (! Schema::hasColumn('tictactoe_matches', 'stake')) {
                $table->unsignedInteger('stake')->default(0);                 // points each player puts in
            }
            if (! Schema::hasColumn('tictactoe_matches', 'fee_percent')) {
                $table->unsignedTinyInteger('fee_percent')->default(0);       // admin fee % fixed when the 2nd player joins
            }
            if (! Schema::hasColumn('tictactoe_matches', 'settled')) {
                $table->boolean('settled')->default(0);                       // 1 once the stakes were paid out / returned
            }
            if (! Schema::hasColumn('tictactoe_matches', 'declined_name')) {
                $table->string('declined_name', 30)->nullable();              // last player who looked at the room and said no
            }
            if (! Schema::hasColumn('tictactoe_matches', 'declined_at')) {
                $table->timestamp('declined_at')->nullable();
            }
        });
    }

    public function down()
    {
        if (! Schema::hasTable('tictactoe_matches')) {
            return;
        }

        Schema::table('tictactoe_matches', function (Blueprint $table) {
            foreach (['stake', 'fee_percent', 'settled', 'declined_name', 'declined_at'] as $col) {
                if (Schema::hasColumn('tictactoe_matches', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
}
