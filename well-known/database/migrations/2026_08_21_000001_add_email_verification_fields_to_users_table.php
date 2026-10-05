<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmailVerificationFieldsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('verification_code', 10)->nullable()->after('email_verified_at');
            $table->timestamp('verification_code_expires_at')->nullable()->after('verification_code');
            $table->timestamp('verification_sent_at')->nullable()->after('verification_code_expires_at');
            $table->unsignedTinyInteger('verification_resend_count')->default(0)->after('verification_sent_at');
            // Admin-only override: when true, this user can log in without
            // completing (or despite failing) code verification.
            $table->boolean('email_verification_override')->default(0)->after('verification_resend_count');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'verification_code',
                'verification_code_expires_at',
                'verification_sent_at',
                'verification_resend_count',
                'email_verification_override',
            ]);
        });
    }
}
