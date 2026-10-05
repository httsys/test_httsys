<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPointsToUsersTable extends Migration
{
    public function up()
    {
        if (Schema::hasColumn('users', 'points')) {
            return;
        }

        Schema::table('users', function (Blueprint $table) {
            $table->unsignedInteger('points')->default(0);
        });
    }

    public function down()
    {
        if (Schema::hasColumn('users', 'points')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('points');
            });
        }
    }
}
