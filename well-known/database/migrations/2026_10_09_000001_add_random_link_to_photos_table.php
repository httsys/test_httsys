<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRandomLinkToPhotosTable extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('photos', 'random_link')) {
            Schema::table('photos', function (Blueprint $table) {
                // 1 = pages use the random /m/... link, 0 = original file URL
                $table->boolean('random_link')->default(1)->after('file');
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('photos', 'random_link')) {
            Schema::table('photos', function (Blueprint $table) {
                $table->dropColumn('random_link');
            });
        }
    }
}
