<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropShowInShopFromPaymentMethodsTable extends Migration
{
    /**
     * Rolling back the earlier "share payment_methods between Donations
     * and Shop via a toggle" approach — Shop now has its own
     * shop_payment_methods table instead, so Donations' payment_methods
     * table goes back to exactly how it was before any of this shop
     * payment work started. Safe to run whether or not the column exists.
     */
    public function up()
    {
        if (Schema::hasColumn('payment_methods', 'show_in_shop')) {
            Schema::table('payment_methods', function (Blueprint $table) {
                $table->dropColumn('show_in_shop');
            });
        }
    }

    public function down()
    {
        Schema::table('payment_methods', function (Blueprint $table) {
            $table->boolean('show_in_shop')->default(false)->after('is_active');
        });
    }
}
