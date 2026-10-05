<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVideoAndShippingInfoToProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // A YouTube/Vimeo (or any embeddable) video URL for the
            // product's "Videos" tab.
            $table->string('video_url')->nullable()->after('digital_link');
            // Product-specific shipping & return policy text. Left blank
            // = the product page falls back to a generic message.
            $table->text('shipping_return_info')->nullable()->after('video_url');
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['video_url', 'shipping_return_info']);
        });
    }
}
