<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentMethodIdToShopOrdersTable extends Migration
{
    public function up()
    {
        // Reuses the same `payment_methods` table the donation module already
        // has (bkash personal number, etc.) — a shop order and a donation can
        // now point at the same manual payment method row, so the admin only
        // has to manage bkash/nagad/bank instructions in one place.
        Schema::table('shop_orders', function (Blueprint $table) {
            $table->unsignedBigInteger('payment_method_id')->nullable()->after('payment_method');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods')->nullOnDelete();

            // What the buyer typed in as proof for a manual payment (their
            // own Trx ID from bKash/Nagad/bank, etc) — same idea as
            // donations.manual_reference.
            $table->string('manual_reference')->nullable()->after('payment_method_id');
        });
    }

    public function down()
    {
        Schema::table('shop_orders', function (Blueprint $table) {
            $table->dropForeign(['payment_method_id']);
            $table->dropColumn(['payment_method_id', 'manual_reference']);
        });
    }
}
