<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateWalletFoundationTables extends Migration
{
    public function up()
    {
        // One wallet per user. Balance is always in Taka (BDT) — the site's
        // one settlement currency. What a listing is priced or sold in
        // (dollars, a product, a bid) is a separate concern for later
        // phases; by the time money touches a wallet it has already been
        // converted to Taka.
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            $table->decimal('balance', 15, 2)->default(0);
            $table->timestamps();
        });

        // Append-only ledger. Every balance change — an escrow release, a
        // withdrawal being approved, a manual admin adjustment — writes one
        // row here. The wallet's `balance` column is the fast-path total;
        // this table is the audit trail if that total is ever questioned.
        Schema::create('wallet_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wallet_id')->constrained()->cascadeOnDelete();
            $table->enum('type', ['credit', 'debit']);
            $table->decimal('amount', 15, 2);
            $table->decimal('balance_after', 15, 2);
            // What caused this entry — 'escrow_release', 'withdrawal',
            // 'withdrawal_reversal', 'admin_adjustment'. Free-text rather
            // than an enum since future phases will add their own sources
            // without needing a migration to extend a fixed list.
            $table->string('source', 60);
            $table->unsignedBigInteger('source_id')->nullable();
            $table->string('description', 255)->nullable();
            $table->timestamps();

            $table->index(['wallet_id', 'created_at']);
        });

        // Generic hold-and-release escrow record. Not tied to any specific
        // listing type yet on purpose — the currency-exchange, marketplace,
        // and auction phases that come next all create one of these when a
        // buyer pays, and this same release/reject flow (mirroring how
        // order and donation payments are already verified in this
        // codebase) settles all three the same way.
        Schema::create('escrow_holds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payer_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('payee_id')->constrained('users')->cascadeOnDelete();

            // 'currency_exchange' | 'marketplace' | 'auction' — which future
            // module this hold belongs to. Nullable for now since nothing
            // creates these yet.
            $table->string('listing_type', 40)->nullable();
            $table->unsignedBigInteger('listing_id')->nullable();

            $table->decimal('amount', 15, 2);
            $table->decimal('fee_amount', 15, 2)->default(0);
            $table->decimal('payout_amount', 15, 2);

            $table->string('payment_method', 60)->nullable();
            $table->string('payment_reference', 191)->nullable();

            $table->enum('status', ['held', 'released', 'rejected'])->default('held');
            $table->text('admin_note')->nullable();
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('reviewed_at')->nullable();

            $table->timestamps();

            $table->index(['listing_type', 'listing_id']);
        });

        Schema::create('withdrawal_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->decimal('amount', 15, 2);
            $table->string('method', 60);
            $table->string('account_details', 255);
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('admin_note')->nullable();
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamps();
        });

        // One row per service type. Phase B/C/D each read their own row by
        // `service_type` — adding a new service later is just inserting a
        // new row, not a migration.
        Schema::create('fee_settings', function (Blueprint $table) {
            $table->id();
            $table->string('service_type', 60)->unique();
            $table->decimal('fixed_fee', 15, 2)->default(0);
            $table->decimal('percent_fee', 5, 2)->default(0);
            $table->timestamps();
        });

        DB::table('fee_settings')->insert([
            ['service_type' => 'currency_exchange', 'fixed_fee' => 0, 'percent_fee' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['service_type' => 'marketplace', 'fixed_fee' => 0, 'percent_fee' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['service_type' => 'auction', 'fixed_fee' => 0, 'percent_fee' => 0, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('fee_settings');
        Schema::dropIfExists('withdrawal_requests');
        Schema::dropIfExists('escrow_holds');
        Schema::dropIfExists('wallet_transactions');
        Schema::dropIfExists('wallets');
    }
}
