<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopPaymentMethodsTable extends Migration
{
    /**
     * Own table for Shop payment methods — completely separate from
     * `payment_methods` (which stays Donations-only, untouched). Same
     * shape, but managed from its own admin screen under Shop, with its
     * own entries. Nothing here is shared with the donation module.
     */
    public function up()
    {
        Schema::create('shop_payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->enum('type', ['manual', 'sslcommerz', 'bkash', 'nagad'])->default('manual');
            $table->text('instructions')->nullable();
            $table->json('config')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shop_payment_methods');
    }
}
