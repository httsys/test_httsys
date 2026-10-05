<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'is_locked',
    ];

    protected $casts = [
        'is_locked' => 'boolean',
    ];

    public function users()
    {
        return $this->hasMany('App\Models\User');
    }

    public function permissions()
    {
        return $this->hasMany(RolePermission::class);
    }

    /**
     * The administrator role always has everything — it's the account that
     * has to be able to fix a broken permission set, so it can never be
     * locked out by one.
     */
    public function isSuperRole()
    {
        return $this->name === 'administrator';
    }

    public function hasPermission($key)
    {
        if ($this->isSuperRole()) {
            return true;
        }

        return in_array($key, $this->permissionKeys(), true);
    }

    /**
     * Cached on the instance — the sidebar alone asks this a few dozen
     * times per page render.
     */
    public function permissionKeys()
    {
        if ($this->cachedPermissionKeys === null) {
            $this->cachedPermissionKeys = $this->permissions()
                ->pluck('permission')
                ->all();
        }

        return $this->cachedPermissionKeys;
    }

    protected $cachedPermissionKeys = null;

    /**
     * Replace this role's permissions with exactly the keys given. Anything
     * not in config/permissions.php is dropped, so a stale or hand-typed
     * key can't sneak in.
     */
    public function syncPermissions(array $keys)
    {
        $valid = array_keys(config('permissions', []));
        $keys = array_values(array_unique(array_intersect($keys, $valid)));

        $this->permissions()->delete();

        $rows = [];
        foreach ($keys as $key) {
            $rows[] = [
                'role_id' => $this->id,
                'permission' => $key,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if (! empty($rows)) {
            RolePermission::insert($rows);
        }

        $this->cachedPermissionKeys = null;
    }
}
