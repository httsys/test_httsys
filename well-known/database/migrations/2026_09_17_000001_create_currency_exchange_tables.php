<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrencyExchangeTables extends Migration
{
    public function up()
    {
        // A seller's standing offer: "I have this much [currency] to sell
        // at this rate." `currency` is a plain string on purpose (not an
        // enum) so adding EUR/GBP later is a UI change, not a migration.
        Schema::create('currency_listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('currency', 10)->default('USD');
            $table->decimal('rate', 15, 4); // Taka per 1 unit of currency
            $table->decimal('amount_available', 15, 2); // total posted for sale
            $table->decimal('amount_reserved', 15, 2)->default(0); // tied up in unreviewed orders
            $table->decimal('amount_sold', 15, 2)->default(0); // completed sales
            $table->decimal('min_order', 15, 2)->nullable();
            $table->decimal('max_order', 15, 2)->nullable();
            $table->text('delivery_note')->nullable(); // how the seller will hand over the currency
            $table->enum('status', ['active', 'paused', 'closed'])->default('active');
            $table->timestamps();

            $table->index(['currency', 'status']);
        });

        // A single buyer's purchase against one listing. Becomes an
        // escrow_holds row (listing_type = 'currency_exchange') once the
        // buyer submits their payment reference — release/reject already
        // happens on the existing Escrow Holds admin page from the wallet
        // foundation; this table just tracks the currency-specific side of
        // that same transaction and mirrors its state.
        Schema::create('currency_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('listing_id')->constrained('currency_listings')->cascadeOnDelete();
            $table->foreignId('buyer_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('seller_id')->constrained('users')->cascadeOnDelete();

            $table->string('currency', 10);
            $table->decimal('currency_amount', 15, 2);
            $table->decimal('rate', 15, 4); // locked at purchase time, independent of later listing edits
            $table->decimal('total_bdt', 15, 2);

            $table->text('receiving_details')->nullable(); // where/how the buyer wants the currency delivered
            $table->foreignId('payment_method_id')->nullable()->constrained('shop_payment_methods')->nullOnDelete();
            $table->string('payment_reference', 191)->nullable();

            $table->foreignId('escrow_hold_id')->nullable()->constrained('escrow_holds')->nullOnDelete();

            // awaiting_payment: order+reservation exist, buyer hasn't submitted a reference yet
            // pending: reference submitted, escrow hold open, waiting on admin
            // completed / rejected: mirrors the escrow hold's final state
            $table->enum('status', ['awaiting_payment', 'pending', 'completed', 'rejected'])->default('awaiting_payment');

            $table->timestamps();

            $table->index('status');
        });
    }

    public function down()
    {
        Schema::dropIfExists('currency_orders');
        Schema::dropIfExists('currency_listings');
    }
}
