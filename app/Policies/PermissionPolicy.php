<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Permission;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
{
    use HandlesAuthorization;



    public function viewAny(User $user)
    {
        return $user->hasRole('admin');
    }


    public function view(User $user, Permission $permission)
    {
        // Check if the user has permission to view this specific permission
        return $user->hasPermissionTo('view permissions');
    }


    public function create(User $user)
    {
        return $user->hasPermissionTo('create permissions');
    }


    public function update(User $user, Permission $permission)
    {
        return $user->hasPermissionTo('update permissions');
    }


    public function delete(User $user, Permission $permission)
    {
        return $user->hasPermissionTo('delete permissions');
    }
}
