<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RolesController extends BaseController
{
    public function index()
    {
        $roles = Role::all();

        return view('roles-permissions.roles.index', compact('roles'));
    }

    public function create()
    {
        $role = null;
        $permissions = Permission::all();
        return view('roles-permissions.roles.create',get_defined_vars());
    }

    public function store(CreateRoleRequest $request)
    {
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
        $permissions = Permission::all();

        return view('roles-permissions.roles.create', compact('role', 'permissions'));
    }

    public function update(UpdateRoleRequest $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->name = $request->input('name');
        $role->description = $request->input('description');
        $role->save();

        // Attach the selected permissions to the role
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

        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
}
