<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('name');
            $table->string('phone');
            $table->string('email')->nullable();

            $table->string('country')->default('Bangladesh');
            $table->string('state'); // Division/State
            $table->string('city');
            $table->string('address_line'); // House/Road/Block etc.
            $table->string('postal_code')->nullable();

            $table->boolean('is_default')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
