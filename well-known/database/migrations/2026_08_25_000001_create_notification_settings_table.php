<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateNotificationSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('notification_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('language_id')->default(0);
            $table->boolean('is_enabled')->default(0);
            $table->unsignedBigInteger('photo_id')->nullable();
            $table->string('badge_text')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('button_text')->nullable();
            $table->string('button_link')->nullable();
            $table->timestamps();
        });

        // Match this app's existing convention (see blog_settings,
        // home_settings, etc.): one row per language, with the row's own
        // id equal to the language's id.
        if (Schema::hasTable('languages')) {
            $languages = DB::table('languages')->get();
            foreach ($languages as $lang) {
                DB::table('notification_settings')->insert([
                    'id' => $lang->id,
                    'language_id' => $lang->id,
                    'is_enabled' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    public function down()
    {
        Schema::dropIfExists('notification_settings');
    }
}
