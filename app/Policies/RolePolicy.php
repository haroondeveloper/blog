<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasPermission('view_roles');
    }

    public function view(User $user, Role $role)
    {
        return $user->hasPermission('view_roles') && $user->role_id === $role->id;
    }

    public function create(User $user)
    {
        return $user->hasPermission('create_roles');
    }

    public function update(User $user, Role $role)
    {
        return $user->hasPermission('update_roles') && $user->role_id === $role->id;
    }

    public function delete(User $user, Role $role)
    {
        return $user->hasPermission('delete_roles') && $user->role_id === $role->id;
    }
}
