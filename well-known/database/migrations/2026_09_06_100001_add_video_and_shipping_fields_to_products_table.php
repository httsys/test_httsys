<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVideoAndShippingFieldsToProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            if (! Schema::hasColumn('products', 'video_url')) {
                $table->string('video_url')->nullable()->after('body');
            }
            if (! Schema::hasColumn('products', 'shipping_return_info')) {
                $table->longText('shipping_return_info')->nullable()->after('video_url');
            }
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'video_url')) {
                $table->dropColumn('video_url');
            }
            if (Schema::hasColumn('products', 'shipping_return_info')) {
                $table->dropColumn('shipping_return_info');
            }
        });
    }
}
