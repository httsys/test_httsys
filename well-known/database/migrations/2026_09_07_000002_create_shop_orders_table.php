<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopOrdersTable extends Migration
{
    public function up()
    {
        // Named shop_orders (not "orders") — this database already has a
        // legacy, unrelated `orders` table (pricing/subscription purchases,
        // 36 existing rows) with a completely different schema. Keeping
        // separate names avoids any collision with that table/data.
        Schema::create('shop_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('address_id')->nullable()->constrained()->nullOnDelete();

            $table->string('ship_name');
            $table->string('ship_phone');
            $table->string('ship_email')->nullable();
            $table->string('ship_country');
            $table->string('ship_state');
            $table->string('ship_city');
            $table->string('ship_address_line');
            $table->string('ship_postal_code')->nullable();

            $table->enum('order_type', ['delivery', 'pickup'])->default('delivery');
            $table->enum('status', ['pending', 'confirmed', 'on_the_way', 'delivered', 'cancelled'])->default('pending');

            $table->string('payment_method')->default('cod');
            $table->enum('payment_status', ['unpaid', 'paid'])->default('unpaid');

            $table->decimal('subtotal', 12, 2)->default(0);
            $table->decimal('tax', 12, 2)->default(0);
            $table->decimal('shipping_charge', 12, 2)->default(0);
            $table->decimal('discount', 12, 2)->default(0);
            $table->decimal('total', 12, 2)->default(0);
            $table->string('currency', 10)->default('USD');

            $table->text('note')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shop_orders');
    }
}
