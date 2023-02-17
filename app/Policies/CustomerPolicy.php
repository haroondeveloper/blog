<?php

namespace App\Policies;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CustomerPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasRole('admin');
    }

    public function view(User $user, Customer $customer)
    {
        return $user->id === $customer->user_id;
    }

    public function create(User $user)
    {
        // Only users with the admin role can create customers
        return $user->hasRole('admin');
    }

    public function update(User $user, Customer $customer)
    {
        return $user->id === $customer->user_id || $user->hasRole('admin');
    }

    public function delete(User $user, Customer $customer)
    {
        return $user->hasRole('admin');
    }
}
