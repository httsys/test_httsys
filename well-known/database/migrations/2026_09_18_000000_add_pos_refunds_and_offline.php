<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

/**
 * Second POS migration — adds refund tracking and offline-sale sync
 * support on top of database/migrations/2026_09_16_000000_add_pos_support.php
 * (run that one first; this one assumes it already ran).
 *
 *  - shop_orders.offline_id     nullable/unique idempotency key. A sale
 *                                rung up while the browser had no internet
 *                                is queued client-side (IndexedDB) with a
 *                                locally-generated id, then POSTed to the
 *                                new /admin/pos/sync route once the
 *                                connection is back. If that POST is ever
 *                                retried (e.g. the connection drops again
 *                                right after a successful sync), this
 *                                column lets the server recognise the
 *                                duplicate and just return the existing
 *                                order instead of creating a second one.
 *  - shop_order_items.refunded_quantity — how many units of this line
 *                                have already been refunded, so the
 *                                refund screen can cap "up to N
 *                                returnable" and nobody can refund the
 *                                same item twice.
 *  - pos_refunds / pos_refund_items — one row per refund transaction and
 *                                one row per refunded line, mirroring
 *                                shop_orders/shop_order_items.
 *  - `pos.refunds.process` permission, granted to the "author" role
 *    (role_id 2) alongside the pos.access / pos.orders.delete permissions
 *    from the first POS migration — refunds move money back out, so this
 *    is deliberately a separate, dangerous-flagged permission rather than
 *    folded into pos.access.
 */
class AddPosRefundsAndOffline extends Migration
{
    public function up()
    {
        if (! Schema::hasColumn('shop_orders', 'offline_id')) {
            Schema::table('shop_orders', function (Blueprint $table) {
                $table->string('offline_id', 64)->nullable()->unique()->after('order_number');
            });
        }

        if (! Schema::hasColumn('shop_order_items', 'refunded_quantity')) {
            Schema::table('shop_order_items', function (Blueprint $table) {
                $table->unsignedInteger('refunded_quantity')->default(0)->after('quantity');
            });
        }

        if (! Schema::hasTable('pos_refunds')) {
            Schema::create('pos_refunds', function (Blueprint $table) {
                $table->id();
                $table->string('refund_number', 32)->unique();
                $table->unsignedBigInteger('order_id');
                $table->string('reason', 191);
                $table->string('refund_method', 20); // cash / card / mfs / other
                $table->boolean('restock')->default(false);
                $table->text('notes')->nullable();
                $table->decimal('subtotal', 12, 2);
                $table->decimal('tax', 12, 2)->default(0);
                $table->decimal('total', 12, 2);
                $table->unsignedBigInteger('processed_by')->nullable();
                $table->timestamps();

                $table->foreign('order_id')->references('id')->on('shop_orders')->onDelete('cascade');
                $table->foreign('processed_by')->references('id')->on('users')->onDelete('set null');
            });
        }

        if (! Schema::hasTable('pos_refund_items')) {
            Schema::create('pos_refund_items', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('refund_id');
                $table->unsignedBigInteger('order_item_id');
                $table->unsignedInteger('quantity');
                $table->decimal('unit_price', 12, 2);
                $table->decimal('tax_rate', 5, 2)->nullable();
                $table->decimal('line_total', 12, 2);
                $table->timestamps();

                $table->foreign('refund_id')->references('id')->on('pos_refunds')->onDelete('cascade');
                $table->foreign('order_item_id')->references('id')->on('shop_order_items')->onDelete('cascade');
            });
        }

        $authorRoleId = DB::table('roles')->where('name', 'author')->value('id') ?? 2;

        if (! DB::table('role_permissions')->where('role_id', $authorRoleId)->where('permission', 'pos.refunds.process')->exists()) {
            DB::table('role_permissions')->insert([
                'role_id' => $authorRoleId,
                'permission' => 'pos.refunds.process',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down()
    {
        DB::table('role_permissions')->where('permission', 'pos.refunds.process')->delete();

        Schema::dropIfExists('pos_refund_items');
        Schema::dropIfExists('pos_refunds');

        if (Schema::hasColumn('shop_order_items', 'refunded_quantity')) {
            Schema::table('shop_order_items', function (Blueprint $table) {
                $table->dropColumn('refunded_quantity');
            });
        }

        if (Schema::hasColumn('shop_orders', 'offline_id')) {
            Schema::table('shop_orders', function (Blueprint $table) {
                $table->dropColumn('offline_id');
            });
        }
    }
}
