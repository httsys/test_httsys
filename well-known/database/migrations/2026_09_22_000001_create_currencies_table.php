<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCurrenciesTable extends Migration
{
    public function up()
    {
        // What shows in the currency dropdown on "Post a Currency Listing"
        // — admin-managed so adding EUR/GBP later is a couple of clicks,
        // not a deploy. currency_listings.currency itself stays a plain
        // string (unrelated to this table) so nothing breaks if a code
        // gets removed here after listings already used it.
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->unique(); // USD, EUR, GBP...
            $table->string('name', 60); // "US Dollar"
            $table->boolean('is_active')->default(1);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // Preserve exactly what's live today — USD only — so the dropdown
        // looks identical after this migration until an admin adds more.
        DB::table('currencies')->insert([
            'code' => 'USD',
            'name' => 'US Dollar',
            'is_active' => 1,
            'sort_order' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('currencies');
    }
}
