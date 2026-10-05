<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class RepointShopOrdersPaymentMethodFk extends Migration
{
    /**
     * shop_orders.payment_method_id previously pointed at the shared
     * `payment_methods` table. Now that Shop has its own
     * `shop_payment_methods` table, point the foreign key there instead.
     * Any existing manual-payment test orders get their
     * payment_method_id cleared first since the old IDs belong to a
     * different table now (harmless — those were test orders).
     */
    public function up()
    {
        // Drop the old FK if it exists (name comes from the earlier
        // migration: 2026_09_09_000001_add_payment_method_id_to_shop_orders_table).
        if ($this->foreignKeyExists('shop_orders', 'shop_orders_payment_method_id_foreign')) {
            Schema::table('shop_orders', function (Blueprint $table) {
                $table->dropForeign('shop_orders_payment_method_id_foreign');
            });
        }

        // Old IDs referenced rows in `payment_methods`, which no longer
        // apply — clear them so the new FK constraint doesn't fail.
        DB::table('shop_orders')->update(['payment_method_id' => null]);

        Schema::table('shop_orders', function (Blueprint $table) {
            $table->foreign('payment_method_id')->references('id')->on('shop_payment_methods')->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::table('shop_orders', function (Blueprint $table) {
            $table->dropForeign(['payment_method_id']);
        });
    }

    protected function foreignKeyExists($table, $foreignKeyName)
    {
        $dbName = DB::getDatabaseName();

        $result = DB::select(
            "SELECT CONSTRAINT_NAME FROM information_schema.TABLE_CONSTRAINTS
             WHERE CONSTRAINT_SCHEMA = ? AND TABLE_NAME = ? AND CONSTRAINT_NAME = ? AND CONSTRAINT_TYPE = 'FOREIGN KEY'",
            [$dbName, $table, $foreignKeyName]
        );

        return count($result) > 0;
    }
}
