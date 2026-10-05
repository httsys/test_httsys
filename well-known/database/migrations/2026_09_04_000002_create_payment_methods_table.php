<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentMethodsTable extends Migration
{
    public function up()
    {
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();

            // 'sslcommerz' / 'bkash' / 'nagad' get real gateway integrations
            // (see DonationController). 'manual' covers anything the admin
            // wants to add without code — bank transfer, Rocket, a personal
            // bKash/Nagad number, cash on delivery, etc. — the donor just
            // reads the admin's instructions and types in a reference.
            $table->enum('type', ['sslcommerz', 'bkash', 'nagad', 'manual'])->default('manual');

            // Shown to the donor for manual methods (account number, phone
            // number, "send money then paste the Trx ID below", etc).
            $table->text('instructions')->nullable();

            // Gateway API credentials (store_id/store_password, app_key/
            // app_secret/username/password, merchant_id/keys, sandbox flag,
            // etc.) — shape depends on `type`. Never rendered to the donor.
            $table->text('config')->nullable();

            $table->boolean('is_active')->default(1);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payment_methods');
    }
}
