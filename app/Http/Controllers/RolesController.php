<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Policies\RolePolicy;
use App\Traits\RolesActions;
use Illuminate\Http\Request;

class RolesController extends BaseController
{
    use RolesActions;

    public function index()
    {


        $this->authorizeToViewAllRoles();
        $roles = Role::all();
        return view('roles-permissions.roles.index', compact('roles'));
    }

    public function create()
    {
        $this->authorizeToCreateRole();
        $role = null;
        $permissions = Permission::all();
        return view('roles-permissions.roles.create', compact('role', 'permissions'));
    }

    public function store(CreateRoleRequest $request)
    {
        $this->authorizeToCreateRole();
        $role = Role::create($request->validated());

        $permissionIds = $request->input('permissions');

        if ($permissionIds) {
            $permissions = Permission::find($permissionIds);
            $role->permissions()->attach($permissions);
        }

        return redirect()->route('roles.index')
            ->with('success', 'Role created successfully.');
    }


    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $this->authorizeToUpdateRole($role);
        $permissions = Permission::all();

        return view('roles-permissions.roles.create', compact('role', 'permissions'));
    }

    public function update(UpdateRoleRequest $request, $id)
    {
        $role = Role::findOrFail($id);
        $this->authorizeToUpdateRole($role);

        $role->name = $request->input('name');
        $role->description = $request->input('description');
        $role->save();

        $permissions = $request->input('permissions');
        if ($permissions) {
            $role->permissions()->sync($permissions);
        } else {
            $role->permissions()->detach();
        }

        return redirect()->route('roles.index')
            ->with('success', 'Role updated successfully');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $this->authorizeToDeleteRole($role);

        $role->delete();

        return redirect()->route('roles.index')
            ->with('success', 'Role deleted successfully.');
    }
}
