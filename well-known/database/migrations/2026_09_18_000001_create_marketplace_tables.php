<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarketplaceTables extends Migration
{
    public function up()
    {
        // One table for both fixed-price and auction listings — they share
        // almost every field (seller, title, image, digital/physical),
        // and the "type" column decides which of the price-related columns
        // actually mean anything.
        Schema::create('marketplace_listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('title', 191);
            $table->text('description')->nullable();
            $table->unsignedInteger('photo_id')->nullable(); // photos.id — not FK-constrained, same reason as profile_update_requests.photo_id (legacy MyISAM/int table)

            $table->enum('listing_type', ['fixed', 'auction'])->default('fixed');

            // Fixed-price fields
            $table->decimal('price', 15, 2)->nullable();
            $table->unsignedInteger('quantity_available')->default(1);
            $table->unsignedInteger('quantity_reserved')->default(0);
            $table->unsignedInteger('quantity_sold')->default(0);

            // Auction fields — single-item only (quantity_available stays 1)
            $table->decimal('starting_price', 15, 2)->nullable();
            $table->decimal('current_bid', 15, 2)->nullable();
            $table->decimal('bid_increment', 15, 2)->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->unsignedBigInteger('winning_bid_id')->nullable();

            // Digital delivery — same idea as the shop's existing digital
            // products (Product::digital_file_id): either an uploaded file
            // (stored via the Photo model, same as everywhere else in this
            // app that accepts an upload) or an external link. If both are
            // empty, this listing is physical.
            $table->unsignedInteger('digital_file_id')->nullable(); // photos.id — not FK-constrained, same reason as photo_id above
            $table->string('digital_link', 191)->nullable();

            $table->enum('status', ['active', 'sold', 'closed', 'expired'])->default('active');

            $table->timestamps();

            $table->index(['listing_type', 'status']);
        });

        Schema::create('marketplace_bids', function (Blueprint $table) {
            $table->id();
            $table->foreignId('listing_id')->constrained('marketplace_listings')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->decimal('amount', 15, 2);
            $table->timestamps();

            $table->index(['listing_id', 'amount']);
        });

        // A completed (or in-progress) purchase — a "Buy Now" on a fixed
        // listing, or the winning bid once an auction ends. Mirrors
        // currency_orders' shape and lifecycle exactly (awaiting_payment →
        // pending → completed/rejected via the shared Escrow Holds page).
        Schema::create('marketplace_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('listing_id')->constrained('marketplace_listings')->cascadeOnDelete();
            $table->foreignId('buyer_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('seller_id')->constrained('users')->cascadeOnDelete();

            $table->unsignedInteger('quantity')->default(1);
            $table->decimal('amount', 15, 2);

            $table->text('receiving_details')->nullable();
            $table->foreignId('payment_method_id')->nullable()->constrained('shop_payment_methods')->nullOnDelete();
            $table->string('payment_reference', 191)->nullable();
            $table->foreignId('escrow_hold_id')->nullable()->constrained('escrow_holds')->nullOnDelete();

            $table->enum('status', ['awaiting_payment', 'pending', 'completed', 'rejected'])->default('awaiting_payment');

            $table->timestamps();

            $table->index('status');
        });
    }

    public function down()
    {
        Schema::dropIfExists('marketplace_orders');
        Schema::dropIfExists('marketplace_bids');
        Schema::dropIfExists('marketplace_listings');
    }
}
