<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameAdsTable extends Migration
{
    public function up()
    {
        if (Schema::hasTable('game_ads')) {
            return;
        }

        Schema::create('game_ads', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('ad_type', 20)->default('link'); // link | image | code
            $table->text('link')->nullable();      // link: page shown full-screen; image: click-through URL
            $table->text('image_url')->nullable(); // image ads only
            $table->longText('code')->nullable();  // code ads only (HTML / script)
            $table->unsignedSmallInteger('duration')->default(30); // countdown seconds
            $table->unsignedInteger('max_show')->default(0);       // 0 = unlimited
            $table->unsignedInteger('shown_count')->default(0);
            $table->boolean('is_active')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('game_ads');
    }
}
