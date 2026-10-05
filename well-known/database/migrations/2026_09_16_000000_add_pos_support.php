<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * Adds everything the new admin POS (Point of Sale) module needs on top of
 * the existing shop + permissions schema, without touching any existing
 * column:
 *
 *  - products.sku          nullable/unique barcode-or-SKU, scanned/typed in
 *                           the POS barcode box to instantly add a product.
 *  - products.tax_rate     optional per-product VAT % override. When left
 *                           empty the POS (and only the POS — the normal
 *                           storefront checkout is untouched) falls back to
 *                           the site-wide config('shop.tax_rate').
 *  - shop_orders.order_type gains a third value 'pos' alongside the existing
 *                           'delivery' and 'pickup' — lets the normal Orders
 *                           screen and the new POS Orders screen both query
 *                           the very same `shop_orders` table.
 *  - shop_orders.served_by, amount_tendered, change_due — which staff
 *                           member rang up the sale, how much cash the
 *                           customer handed over, and the change given back.
 *  - shop_order_items.tax_rate, line_tax — snapshot of the tax actually
 *                           charged on each line at sale time, so a
 *                           reprinted receipt stays accurate even if a
 *                           product's tax_rate is edited afterwards.
 *  - A single "Walking Customer" user (role: subscriber) is seeded so a
 *    POS sale with no specific customer picked still has a valid,
 *    real users.id to satisfy shop_orders.user_id (NOT NULL, existing
 *    column — left exactly as it was).
 *  - Two `role_permissions` rows granting the "author" role (role_id 2)
 *    the new `pos.access` / `pos.orders.delete` permission keys (see
 *    config/permissions.php, which must be deployed alongside this
 *    migration for those keys to mean anything) — so Administrator and
 *    Author both get POS access immediately, per the original
 *    requirement, without a manual trip to the Roles screen. The
 *    "administrator" role needs no row: Role::isSuperRole() already
 *    grants it everything.
 *
 * Note: this app's `users.is_active` column already exists and is
 * already the real, login-enforced active/inactive flag — the POS
 * "Customers" quick-add form's Active/Inactive toggle reuses that
 * exact column, no new column needed for it.
 */
class AddPosSupport extends Migration
{
    public function up()
    {
        if (! Schema::hasColumn('products', 'sku')) {
            Schema::table('products', function (Blueprint $table) {
                $table->string('sku', 64)->nullable()->unique()->after('slug');
            });
        }

        if (! Schema::hasColumn('products', 'tax_rate')) {
            Schema::table('products', function (Blueprint $table) {
                $table->decimal('tax_rate', 5, 2)->nullable()->after('sale_price');
            });
        }

        // Widen the order_type enum to also allow 'pos'. Raw SQL because
        // altering an existing ENUM's value list needs doctrine/dbal for
        // Schema::table(...)->change(), which this app doesn't have
        // installed — a plain MODIFY statement avoids that dependency.
        DB::statement("ALTER TABLE `shop_orders` MODIFY `order_type` ENUM('delivery','pickup','pos') NOT NULL DEFAULT 'delivery'");

        if (! Schema::hasColumn('shop_order_items', 'tax_rate')) {
            Schema::table('shop_order_items', function (Blueprint $table) {
                $table->decimal('tax_rate', 5, 2)->nullable()->after('unit_price');
                $table->decimal('line_tax', 12, 2)->nullable()->after('tax_rate');
            });
        }

        if (! Schema::hasColumn('shop_orders', 'served_by')) {
            Schema::table('shop_orders', function (Blueprint $table) {
                $table->unsignedBigInteger('served_by')->nullable()->after('user_id');
                $table->foreign('served_by')->references('id')->on('users')->onDelete('set null');
            });
        }

        if (! Schema::hasColumn('shop_orders', 'amount_tendered')) {
            Schema::table('shop_orders', function (Blueprint $table) {
                $table->decimal('amount_tendered', 12, 2)->nullable();
            });
        }

        if (! Schema::hasColumn('shop_orders', 'change_due')) {
            Schema::table('shop_orders', function (Blueprint $table) {
                $table->decimal('change_due', 12, 2)->nullable();
            });
        }

        // Seed the "Walking Customer" fallback user used when a POS sale
        // has no specific customer selected — only if it doesn't exist yet
        // (safe to re-run).
        if (! DB::table('users')->where('email', 'walking-customer@pos.local')->exists()) {
            DB::table('users')->insert([
                'name' => 'Walking Customer',
                'role_id' => 3, // subscriber — never an admin/author account
                'is_active' => 1,
                'email' => 'walking-customer@pos.local',
                'email_verified_at' => now(),
                'email_verification_override' => 1,
                'password' => bcrypt(Str::random(40)), // unusable random password; nobody logs in as this account
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Grant the "author" role (id 2) the two new POS permissions, so it
        // works immediately without an admin visiting Roles & Permissions.
        // Administrator needs nothing — Role::isSuperRole() covers it.
        $authorRoleId = DB::table('roles')->where('name', 'author')->value('id') ?? 2;

        foreach (['pos.access', 'pos.orders.delete'] as $permission) {
            $exists = DB::table('role_permissions')
                ->where('role_id', $authorRoleId)
                ->where('permission', $permission)
                ->exists();

            if (! $exists) {
                DB::table('role_permissions')->insert([
                    'role_id' => $authorRoleId,
                    'permission' => $permission,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    public function down()
    {
        DB::table('role_permissions')
            ->whereIn('permission', ['pos.access', 'pos.orders.delete'])
            ->delete();

        if (Schema::hasColumn('shop_orders', 'served_by')) {
            Schema::table('shop_orders', function (Blueprint $table) {
                $table->dropForeign(['served_by']);
                $table->dropColumn('served_by');
            });
        }

        if (Schema::hasColumn('shop_orders', 'amount_tendered')) {
            Schema::table('shop_orders', function (Blueprint $table) {
                $table->dropColumn('amount_tendered');
            });
        }

        if (Schema::hasColumn('shop_orders', 'change_due')) {
            Schema::table('shop_orders', function (Blueprint $table) {
                $table->dropColumn('change_due');
            });
        }

        DB::statement("ALTER TABLE `shop_orders` MODIFY `order_type` ENUM('delivery','pickup') NOT NULL DEFAULT 'delivery'");

        if (Schema::hasColumn('shop_order_items', 'tax_rate')) {
            Schema::table('shop_order_items', function (Blueprint $table) {
                $table->dropColumn(['tax_rate', 'line_tax']);
            });
        }

        if (Schema::hasColumn('products', 'sku')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('sku');
            });
        }

        if (Schema::hasColumn('products', 'tax_rate')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('tax_rate');
            });
        }

        DB::table('users')->where('email', 'walking-customer@pos.local')->delete();
    }
}
