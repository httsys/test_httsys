<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopOrderItemsTable extends Migration
{
    public function up()
    {
        Schema::create('shop_order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('shop_orders')->cascadeOnDelete();
            $table->foreignId('product_id')->nullable()->constrained()->nullOnDelete();

            $table->string('product_title');
            $table->string('product_image')->nullable();
            $table->string('variant_summary')->nullable();

            $table->decimal('unit_price', 12, 2);
            $table->unsignedInteger('quantity');
            $table->decimal('line_total', 12, 2);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shop_order_items');
    }
}
