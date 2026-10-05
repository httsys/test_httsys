<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePickupLocationsTable extends Migration
{
    public function up()
    {
        Schema::create('pickup_locations', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g. "Dhanmondi 27"
            $table->string('address_line');
            $table->string('city');
            $table->string('state')->nullable();
            $table->string('country')->default('Bangladesh');
            $table->string('postal_code')->nullable();
            $table->string('phone')->nullable();
            $table->boolean('is_active')->default(1);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pickup_locations');
    }
}
