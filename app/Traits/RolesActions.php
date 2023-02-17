<?php

namespace App\Traits;

use App\Models\Role;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Gate;

trait RolesActions
{
    public function authorizeToViewAllRoles()
    {
        if (Gate::denies('viewAny', Role::class)) {
            throw new AuthorizationException("You are not authorized to view roles.");
        }
    }

    public function authorizeToCreateRole()
    {
        if (Gate::denies('create', Role::class)) {
            throw new AuthorizationException("You are not authorized to create roles.");
        }
    }

    public function authorizeToUpdateRole(Role $role)
    {
        if (Gate::denies('update', $role)) {
            throw new AuthorizationException("You are not authorized to update this role.");
        }
    }

    public function authorizeToDeleteRole(Role $role)
    {
        if (Gate::denies('delete', $role)) {
            throw new AuthorizationException("You are not authorized to delete this role.");
        }
    }
}
