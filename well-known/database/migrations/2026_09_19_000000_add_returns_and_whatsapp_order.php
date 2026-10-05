<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

/**
 * Adds three separate customer-facing/admin features on top of the
 * existing schema:
 *
 *  - settings.whatsapp_order_number — a phone number (with country code,
 *    e.g. 8801XXXXXXXXX) admin sets in Settings. When a customer places
 *    an order, the confirmation page offers a "Send order via WhatsApp"
 *    button that opens a wa.me link to this number with the order's
 *    details pre-filled — the customer taps Send. (There is no paid
 *    WhatsApp Business API integration here — this is the same
 *    zero-cost wa.me click-to-chat approach used by the existing
 *    "chat with us" floating button, just pointed at a dedicated
 *    order-notifications number instead of the general contact number,
 *    and pre-filled with the order instead of being blank.)
 *  - order_returns / order_return_items — a customer-initiated return
 *    request for a delivered order (separate from `pos_refunds`, which
 *    is the staff-initiated, immediate, in-person POS refund flow added
 *    earlier). Goes through a pending → accepted/rejected review by an
 *    admin/author before anything is refunded.
 *  - `orders.returns.manage` permission (review/accept/reject return
 *    requests), granted to the "author" role like the other order
 *    permissions it already has.
 */
class AddReturnsAndWhatsappOrder extends Migration
{
    public function up()
    {
        if (! Schema::hasColumn('settings', 'whatsapp_order_number')) {
            Schema::table('settings', function (Blueprint $table) {
                $table->string('whatsapp_order_number', 30)->nullable()->after('whatsapp');
            });
        }

        if (! Schema::hasTable('order_returns')) {
            Schema::create('order_returns', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('order_id');
                $table->unsignedBigInteger('user_id');
                $table->string('reason', 191);
                $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
                $table->text('admin_note')->nullable();
                $table->unsignedBigInteger('reviewed_by')->nullable();
                $table->timestamp('reviewed_at')->nullable();
                $table->timestamps();

                $table->foreign('order_id')->references('id')->on('shop_orders')->onDelete('cascade');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('reviewed_by')->references('id')->on('users')->onDelete('set null');
            });
        }

        if (! Schema::hasTable('order_return_items')) {
            Schema::create('order_return_items', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('return_id');
                $table->unsignedBigInteger('order_item_id');
                $table->unsignedInteger('quantity');
                $table->timestamps();

                $table->foreign('return_id')->references('id')->on('order_returns')->onDelete('cascade');
                $table->foreign('order_item_id')->references('id')->on('shop_order_items')->onDelete('cascade');
            });
        }

        $authorRoleId = DB::table('roles')->where('name', 'author')->value('id') ?? 2;

        if (! DB::table('role_permissions')->where('role_id', $authorRoleId)->where('permission', 'orders.returns.manage')->exists()) {
            DB::table('role_permissions')->insert([
                'role_id' => $authorRoleId,
                'permission' => 'orders.returns.manage',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down()
    {
        DB::table('role_permissions')->where('permission', 'orders.returns.manage')->delete();

        Schema::dropIfExists('order_return_items');
        Schema::dropIfExists('order_returns');

        if (Schema::hasColumn('settings', 'whatsapp_order_number')) {
            Schema::table('settings', function (Blueprint $table) {
                $table->dropColumn('whatsapp_order_number');
            });
        }
    }
}
