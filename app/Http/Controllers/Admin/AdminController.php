<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Create a new user
    public function createUser(CreateUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    // Create a new role
    public function createRole(CreateRoleRequest $request)
    {
        $role = Role::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return redirect()->route('roles.index')->with('success', 'Role created successfully');
    }

    // Create a new permission
    public function createPermission(CreatePermissionRequest $request)
    {
        $permission = Permission::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return redirect()->route('permissions.index')->with('success', 'Permission created successfully');
    }

    // Assign role to user
    public function assignRoleToUser(User $user, Role $role)
    {
        $this->authorize('assignRole', $user);
        $user->roles()->sync($role);
        return redirect()->back()->with('success', 'Role assigned to user successfully');
    }
}
