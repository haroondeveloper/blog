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
        return $user->hasRole('view_roles');
    }

    public function view(User $user, Role $role)
    {
        return $user->hasRole('view_roles') && $user->role_id === $role->id;
    }

    public function create(User $user)
    {
        return $user->hasRole('create_roles');
    }

    public function update(User $user, Role $role)
    {
        return $user->hasRole('update_roles') && $user->role_id === $role->id;
    }

    public function delete(User $user, Role $role)
    {
        return $user->hasRole('delete_roles') && $user->role_id === $role->id;
    }
}
