<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Models\Permission;
use App\Policies\PermissionPolicy;
use App\Traits\PermissionsActions;

class PermissionsController extends BaseController
{
    use PermissionsActions;

    public function index()
    {
        $this->authorizeViewAnyPermission();
        $permissions = Permission::all();
        return view('roles-permissions.permissions.index', compact('permissions'));
    }

    public function create()
    {
        $this->authorize('create', Permission::class);
        return view('roles-permissions.permissions.create');
    }

    public function store(CreatePermissionRequest $request)
    {
        $this->authorizeCreatePermission();
        $permission = Permission::updateOrCreate(
            ['id' => $request->id],
            ['name' => $request->name, 'slug' => $request->slug]
        );

        return redirect()->route('permissions.index')
            ->with('success', 'Permission Added successfully.');
    }

    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        $this->authorizeUpdatePermission($permission);
        return view('roles-permissions.permissions.create', compact('permission'));
    }

    public function update(UpdatePermissionRequest $request, $id)
    {
        $permission = Permission::find($id);
        $this->authorizeUpdatePermission($permission);
        $permission->update($request->validated());
        return redirect()->route('permissions.index')
            ->with('success', 'Permission updated successfully.');
    }

    public function destroy($id)
    {
        $permission = Permission::find($id);
        $this->authorizeDeletePermission($permission);
        $permission->delete();
        return redirect()->route('permissions.index')
            ->with('success', 'Permission deleted successfully.');
    }
}
