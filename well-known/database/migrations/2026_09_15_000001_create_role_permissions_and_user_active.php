<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateRolePermissionsAndUserActive extends Migration
{
    public function up()
    {
        // Which permission keys each role has been granted. One row per
        // ticked checkbox on the role screen. The keys themselves live in
        // config/permissions.php — nothing here needs changing when a new
        // feature is added to the site.
        Schema::create('role_permissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id');
            $table->string('permission', 191);
            $table->timestamps();

            $table->unique(['role_id', 'permission']);
            $table->index('role_id');
        });

        Schema::table('roles', function (Blueprint $table) {
            if (! Schema::hasColumn('roles', 'description')) {
                $table->string('description', 255)->nullable()->after('name');
            }
            // Protects the built-in administrator role from being edited
            // into something that locks everyone out of the panel.
            if (! Schema::hasColumn('roles', 'is_locked')) {
                $table->boolean('is_locked')->default(0)->after('description');
            }
        });

        Schema::table('users', function (Blueprint $table) {
            if (! Schema::hasColumn('users', 'is_active')) {
                $table->boolean('is_active')->default(1)->after('role_id');
            }
        });

        // Everyone who already exists stays active — this must not lock
        // anybody out of an account that worked yesterday.
        DB::table('users')->update(['is_active' => 1]);

        // The administrator role bypasses permission checks in code, but
        // lock it so nobody can accidentally strip it on the role screen.
        DB::table('roles')->where('name', 'administrator')->update(['is_locked' => 1]);

        // Give the existing "author" role a sensible starting set so the
        // panel keeps working exactly as it does today for those users.
        $authorRole = DB::table('roles')->where('name', 'author')->first();

        if ($authorRole) {
            $defaults = [
                'dashboard.view',
                'shop.products.view',
                'shop.products.manage',
                'shop.categories.manage',
                'shop.brands.manage',
                'shop.coupons.manage',
                'shop.pickup_locations.manage',
                'shop.payment_methods.manage',
                'orders.view',
                'orders.verify_payment',
                'orders.update_status',
                'donations.view',
                'donations.verify',
                'donations.funds.manage',
                'donations.payment_methods.manage',
                'users.view',
                'users.create',
                'users.update',
                'users.profile_requests',
                'content.posts.manage',
                'content.categories.manage',
                'content.comments.manage',
                'content.media.manage',
            ];

            $rows = [];
            foreach ($defaults as $permission) {
                $rows[] = [
                    'role_id' => $authorRole->id,
                    'permission' => $permission,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            DB::table('role_permissions')->insert($rows);
        }
    }

    public function down()
    {
        Schema::dropIfExists('role_permissions');

        Schema::table('roles', function (Blueprint $table) {
            if (Schema::hasColumn('roles', 'description')) {
                $table->dropColumn('description');
            }
            if (Schema::hasColumn('roles', 'is_locked')) {
                $table->dropColumn('is_locked');
            }
        });

        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'is_active')) {
                $table->dropColumn('is_active');
            }
        });
    }
}
