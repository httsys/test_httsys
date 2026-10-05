<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductReviewsTable extends Migration
{
    public function up()
    {
        if (Schema::hasTable('product_reviews')) {
            return;
        }

        Schema::create('product_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');

            // Plain column (no FK constraint) — the `users` table on this
            // install is MyISAM, and InnoDB foreign keys can't reference a
            // MyISAM table ("Foreign key constraint is incorrectly formed").
            // Referential integrity for user_id is enforced in application
            // code instead (ShopController always sets it from Auth::id()).
            $table->unsignedBigInteger('user_id');

            $table->unsignedTinyInteger('rating'); // 1-5
            $table->text('comment')->nullable();
            $table->timestamps();

            // one review per user per product; re-submitting updates it
            $table->unique(['product_id', 'user_id']);
            $table->index('user_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_reviews');
    }
}
