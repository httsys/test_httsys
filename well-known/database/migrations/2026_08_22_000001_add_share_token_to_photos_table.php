<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class AddShareTokenToPhotosTable extends Migration
{
    public function up()
    {
        Schema::table('photos', function (Blueprint $table) {
            $table->string('share_token', 40)->nullable()->unique()->after('id');
        });

        // Backfill a unique token for every photo uploaded before this
        // migration ran, so existing "Copy Share Link" buttons keep working.
        DB::table('photos')->whereNull('share_token')->orderBy('id')->chunkById(200, function ($photos) {
            foreach ($photos as $photo) {
                DB::table('photos')->where('id', $photo->id)->update([
                    'share_token' => Str::random(32) . $photo->id,
                ]);
            }
        });
    }

    public function down()
    {
        Schema::table('photos', function (Blueprint $table) {
            $table->dropColumn('share_token');
        });
    }
}
