<?php

namespace App\Repositories\Dashboard;

use App\Models\Role;

class RoleRepository
{

    public function getRoles()
    {
        $roles = Role::select('id', 'role', 'permissions')->paginate(6);
        return $roles;
    }


    public function createRole($request)
    {
        $role = Role::create([
            'role' => $request->role,
            'permissions' => $request->permissions,
        ]);

        return $role;
    }

    public function getRole($id)
    {
        $role = Role::find($id);
        return $role;
    }

    public function updateRole($request, $role)
    {
        $role = $role->update([
            'role' => $request->role,
            'permissions' => json_encode($request->permissions),
        ]);
        return $role;
    }

    public function destroy($role)
    {
        return $role->delete();
    }
}
