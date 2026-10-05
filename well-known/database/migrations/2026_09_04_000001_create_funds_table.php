<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFundsTable extends Migration
{
    public function up()
    {
        Schema::create('funds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('language_id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('short_description')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('photo_id')->nullable();

            // Optional fundraising goal. Both nullable/zero-default so a
            // fund can simply collect donations with no target shown.
            $table->decimal('target_amount', 14, 2)->nullable();

            // Running total of completed donations, kept in sync from
            // DonationController whenever a donation's status becomes
            // 'completed' — avoids a SUM() query on every page load.
            $table->decimal('collected_amount', 14, 2)->default(0);

            $table->boolean('is_active')->default(1);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('funds');
    }
}
