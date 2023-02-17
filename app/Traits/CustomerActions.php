<?php



namespace App\Traits;

use App\Models\Customer;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;

trait CustomerActions
{
    public function authorizeCustomer(Customer $customer)
    {
        if (Auth::user()->cannot('view', $customer)) {
            throw new AuthorizationException('You are not authorized to perform this action.');
        }
    }

    public function authorizeCreateCustomer()
    {
        if (Auth::user()->cannot('create', Customer::class)) {
            throw new AuthorizationException('You are not authorized to perform this action.');
        }
    }

    public function authorizeUpdateCustomer(Customer $customer)
    {
        if (Auth::user()->cannot('update', $customer)) {
            throw new AuthorizationException('You are not authorized to perform this action.');
        }
    }

    public function authorizeDeleteCustomer(Customer $customer)
    {
        if (Auth::user()->cannot('delete', $customer)) {
            throw new AuthorizationException('You are not authorized to perform this action.');
        }
    }
}
