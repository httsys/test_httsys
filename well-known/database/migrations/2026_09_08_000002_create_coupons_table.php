<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->enum('type', ['fixed', 'percent'])->default('fixed');
            $table->decimal('value', 12, 2); // fixed: currency amount off; percent: 0-100
            $table->decimal('max_discount', 12, 2)->nullable(); // caps a percent discount
            $table->decimal('min_subtotal', 12, 2)->nullable(); // minimum cart subtotal to qualify
            $table->unsignedInteger('usage_limit')->nullable(); // null = unlimited
            $table->unsignedInteger('used_count')->default(0);
            $table->timestamp('expires_at')->nullable();
            $table->boolean('is_active')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('coupons');
    }
}
