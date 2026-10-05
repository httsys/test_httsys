<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVariantGroupsTable extends Migration
{
    public function up()
    {
        if (Schema::hasTable('product_variant_groups')) {
            return;
        }

        Schema::create('product_variant_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('name'); // e.g. Color, Ram, Storage, Region/Variant
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_variant_groups');
    }
}
