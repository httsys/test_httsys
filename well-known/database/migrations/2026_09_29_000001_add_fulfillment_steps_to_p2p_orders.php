<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFulfillmentStepsToP2pOrders extends Migration
{
    /**
     * The seller-side and buyer-side steps that sit on top of the admin's
     * escrow release: after a buyer pays, the seller sees the buyer's
     * details and either releases (hands over the currency/product) or
     * rejects with a reason; if released, the buyer confirms receipt.
     * The admin sees all of it next to the escrow hold.
     */
    public function up()
    {
        foreach (['currency_orders', 'marketplace_orders'] as $tableName) {
            Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                if (! Schema::hasColumn($tableName, 'seller_status')) {
                    $table->enum('seller_status', ['pending', 'released', 'rejected'])->default('pending');
                }
                if (! Schema::hasColumn($tableName, 'seller_note')) {
                    $table->text('seller_note')->nullable();
                }
                if (! Schema::hasColumn($tableName, 'seller_acted_at')) {
                    $table->timestamp('seller_acted_at')->nullable();
                }
                if (! Schema::hasColumn($tableName, 'buyer_confirmed_at')) {
                    $table->timestamp('buyer_confirmed_at')->nullable();
                }
            });
        }
    }

    public function down()
    {
        foreach (['currency_orders', 'marketplace_orders'] as $tableName) {
            Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                foreach (['seller_status', 'seller_note', 'seller_acted_at', 'buyer_confirmed_at'] as $col) {
                    if (Schema::hasColumn($tableName, $col)) {
                        $table->dropColumn($col);
                    }
                }
            });
        }
    }
}
