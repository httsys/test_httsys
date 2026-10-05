<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('language_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('product_category_id');
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->unsignedBigInteger('photo_id')->nullable(); // main image (direct upload)

            // Extra gallery images: pasted media-library URLs, same
            // convention as projects.img_gal1-4 (copy URL from Media,
            // paste here) rather than a separate upload widget.
            $table->text('img_gal1')->nullable();
            $table->text('img_gal2')->nullable();
            $table->text('img_gal3')->nullable();
            $table->text('img_gal4')->nullable();

            $table->string('title');
            $table->string('slug')->unique();
            $table->text('short_description')->nullable();
            $table->longText('body')->nullable();

            // 'digital' = downloadable/deliverable online (source code,
            // theme, account, license key, gift card, game coin, etc.)
            // 'physical' = shipped item (gadgets etc.)
            $table->enum('type', ['digital', 'physical'])->default('physical');

            $table->decimal('price', 12, 2)->default(0);
            $table->decimal('sale_price', 12, 2)->nullable();

            // Only meaningful for physical products; digital products are
            // treated as unlimited/instant-delivery unless stock is set.
            $table->integer('stock')->nullable();

            // For digital products: the actual deliverable file, reusing
            // the existing Photo/media model which already supports any
            // file type (see AdminMediasController).
            $table->unsignedBigInteger('digital_file_id')->nullable();
            // Optional external link instead of/alongside a file (e.g. a
            // redeem/activation instructions page, a Drive folder, etc.)
            $table->string('digital_link')->nullable();

            // Warranty: how long after purchase the customer is covered /
            // can request service or renewal.
            $table->integer('warranty_duration')->nullable();
            $table->enum('warranty_unit', ['days', 'months', 'years'])->nullable();

            $table->boolean('is_flash_sale')->default(0);
            $table->boolean('is_active')->default(1);

            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
