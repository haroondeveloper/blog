<?php
namespace App\Traits;

use App\Models\Permission;

trait PermissionsActions
{
    public function authorizeViewAnyPermission()
    {
        $this->authorize('viewAny', Permission::class);
    }

    public function authorizeCreatePermission()
    {
        $this->authorize('create', Permission::class);
    }

    public function authorizeUpdatePermission(Permission $permission)
    {
        $this->authorize('update', $permission);
    }

    public function authorizeDeletePermission(Permission $permission)
    {
        $this->authorize('delete', $permission);
    }
}
