<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAttributesTable extends Migration
{
    public function up()
    {
        Schema::create('product_attributes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            // e.g. "Color", "Size", "RAM", "Storage", "Material", "Weight",
            // "Region" — or any custom name the admin types in.
            $table->string('name');
            // e.g. "Red", "XL", "8GB" — for multi-option attributes like
            // Color, store comma-separated values ("Red, Black, White") so
            // they render as selectable pills on the product page.
            $table->string('value');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_attributes');
    }
}
