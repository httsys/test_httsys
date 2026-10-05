<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNoteAndLoginTrackingToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Private notepad text for the user. Never shown on the public website.
            $table->longText('note')->nullable()->after('phone');

            // Quick-access snapshot of the most recent login (full history lives in login_logs).
            $table->timestamp('last_login_at')->nullable()->after('note');
            $table->string('last_login_ip', 45)->nullable()->after('last_login_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['note', 'last_login_at', 'last_login_ip']);
        });
    }
}
