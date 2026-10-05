<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPickupAndCouponToShopOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('shop_orders', function (Blueprint $table) {
            $table->foreignId('pickup_location_id')->nullable()->after('address_id')->constrained()->nullOnDelete();
            $table->string('coupon_code')->nullable()->after('discount');
        });
    }

    public function down()
    {
        Schema::table('shop_orders', function (Blueprint $table) {
            $table->dropConstrainedForeignId('pickup_location_id');
            $table->dropColumn('coupon_code');
        });
    }
}
