<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionsController extends BaseController
{
    public function index()
    {
        $permissions = Permission::all();
        return view('roles-permissions.permissions.index',get_defined_vars());
    }

    public function create()
    {
        return view('roles-permissions.permissions.create');
    }

    public function store(CreatePermissionRequest $request)
    {
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
        return view('roles-permissions.permissions.create', get_defined_vars());
    }

    public function update(UpdatePermissionRequest $request, $id)
    {
        $permission = Permission::find($id);
        $permission->update($request->validated());
        return redirect()->route('permissions.index')
            ->with('success', 'Permission updated successfully.');
    }

    public function destroy($id)
    {
        $permission = Permission::find($id);
        $permission->delete();
        return redirect()->route('permissions.index')
            ->with('success', 'Permission deleted successfully.');
    }
}
