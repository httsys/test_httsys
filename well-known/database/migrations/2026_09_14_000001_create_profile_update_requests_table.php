<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileUpdateRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('profile_update_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // Only the fields the user is actually allowed to change (never
            // email — that stays admin/verification controlled). Null on
            // any of these means "leave that field alone" when approved.
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            // Not a real FK constraint: the `photos` table is legacy MyISAM
            // (int id, not bigint) and doesn't support foreign keys — same
            // reason `users.photo_id` itself isn't a constrained column.
            $table->unsignedInteger('photo_id')->nullable();

            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('reviewed_at')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('profile_update_requests');
    }
}
