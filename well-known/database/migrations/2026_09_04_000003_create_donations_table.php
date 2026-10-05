<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationsTable extends Migration
{
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('fund_id');
            $table->unsignedBigInteger('payment_method_id');

            // Nullable so guests can donate without an account — they're
            // tracked/matched to their profile later via donor_mobile /
            // donor_email instead.
            $table->unsignedBigInteger('user_id')->nullable();

            $table->string('donor_name')->nullable();
            $table->string('donor_mobile')->nullable();
            $table->string('donor_email')->nullable();

            $table->decimal('amount', 14, 2);

            // Our own reference shown to the donor and sent to the gateway.
            $table->string('reference')->unique();

            // Gateway's own transaction id, filled in on the success callback.
            $table->string('transaction_id')->nullable();

            // What the donor typed in as proof for a manual payment method
            // (their own Trx ID from bKash/Nagad/bank, etc).
            $table->string('manual_reference')->nullable();

            $table->enum('status', ['pending', 'completed', 'failed', 'cancelled'])->default('pending');

            // Raw gateway callback payload, kept for troubleshooting disputed payments.
            $table->text('gateway_response')->nullable();

            $table->timestamp('paid_at')->nullable();
            $table->timestamps();

            $table->index(['fund_id', 'status']);
            $table->index(['donor_mobile']);
            $table->index(['donor_email']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('donations');
    }
}
