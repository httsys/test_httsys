<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVariantOptionsTable extends Migration
{
    public function up()
    {
        if (Schema::hasTable('product_variant_options')) {
            return;
        }

        Schema::create('product_variant_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_variant_group_id')->constrained()->onDelete('cascade');
            $table->string('value'); // e.g. "Cosmic Orange", "8GB", "512GB", "USA (Dual e-Sim)"
            $table->string('color_code')->nullable(); // hex code, used for Color-type groups
            $table->decimal('price_modifier', 12, 2)->default(0);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_variant_options');
    }
}
