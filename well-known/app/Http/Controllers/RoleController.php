<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    /**
     * Turns config/permissions.php into the grouped structure the role
     * screen renders. Because it reads the config live, adding a new
     * feature's permission there makes its checkbox appear here with no
     * other change.
     */
    protected function groupedPermissions()
    {
        $grouped = [];

        foreach (config('permissions', []) as $key => $meta) {
            $group = $meta['group'] ?? 'Other';

            $grouped[$group][] = [
                'key' => $key,
                'label' => $meta['label'] ?? $key,
                'dangerous' => ! empty($meta['dangerous']),
            ];
        }

        return $grouped;
    }

    public function index()
    {
        $roles = Role::withCount('users')->orderBy('name')->get();

        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        return view('roles.create', [
            'grouped' => $this->groupedPermissions(),
            'selected' => [],
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:roles,name'],
            'description' => ['nullable', 'string', 'max:255'],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['string'],
        ]);

        $role = Role::create([
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'is_locked' => 0,
        ]);

        $role->syncPermissions($request->input('permissions', []));

        return redirect()->route('roles.index')
            ->with('role_success', 'Role created.');
    }

    public function edit(Role $role)
    {
        return view('roles.edit', [
            'role' => $role,
            'grouped' => $this->groupedPermissions(),
            'selected' => $role->permissionKeys(),
        ]);
    }

    public function update(Request $request, Role $role)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100', Rule::unique('roles', 'name')->ignore($role->id)],
            'description' => ['nullable', 'string', 'max:255'],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['string'],
        ]);

        // The administrator role keeps its name and its full access — it's
        // the account that has to be able to repair everything else.
        if ($role->is_locked) {
            $role->update(['description' => $data['description'] ?? null]);

            return redirect()->route('roles.index')
                ->with('role_success', 'Description updated. The administrator role always keeps full access.');
        }

        $role->update([
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
        ]);

        $role->syncPermissions($request->input('permissions', []));

        return redirect()->route('roles.index')
            ->with('role_success', 'Role updated.');
    }

    public function destroy(Role $role)
    {
        if ($role->is_locked) {
            return back()->with('role_error', "The administrator role can't be deleted.");
        }

        if ($role->users()->count() > 0) {
            return back()->with('role_error', 'Move those users to another role first — this role is still in use.');
        }

        $role->permissions()->delete();
        $role->delete();

        return back()->with('role_success', 'Role deleted.');
    }
}
