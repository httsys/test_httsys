<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddShowInShopToPaymentMethodsTable extends Migration
{
    public function up()
    {
        // Donations keep working exactly as before (still governed by
        // is_active only). This is a separate, explicit opt-in switch so
        // the admin decides — per payment method — whether it should also
        // appear as a selectable option on the Shop checkout page. New
        // and existing methods default to OFF for Shop until the admin
        // turns it on.
        Schema::table('payment_methods', function (Blueprint $table) {
            $table->boolean('show_in_shop')->default(false)->after('is_active');
        });
    }

    public function down()
    {
        Schema::table('payment_methods', function (Blueprint $table) {
            $table->dropColumn('show_in_shop');
        });
    }
}
