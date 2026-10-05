<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletTopupRequestsTable extends Migration
{
    public function up()
    {
        // The mirror image of withdrawal_requests: money moving IN to a
        // wallet instead of out. Same manual-payment-then-admin-confirms
        // pattern as everywhere else in this app — user pays the site's
        // bKash/Nagad/bank number, submits a reference, admin approves.
        Schema::create('wallet_topup_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->decimal('amount', 15, 2);
            $table->foreignId('payment_method_id')->nullable()->constrained('shop_payment_methods')->nullOnDelete();
            $table->string('payment_reference', 191)->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('admin_note')->nullable();
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('wallet_topup_requests');
    }
}
