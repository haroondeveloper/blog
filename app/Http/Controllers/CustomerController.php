<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use App\Models\Role;
use App\Policies\CustomerPolicy;
use Illuminate\Support\Facades\Gate;
use App\Traits\CustomerActions;
use Illuminate\Support\Facades\Hash;

class CustomerController extends BaseController
{

    use CustomerActions;


    public function index()
    {
        $this->authorize('viewAny', Customer::class);
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        $this->authorize('create', Customer::class);

        $roles = Role::all();

        return view('customers.create', get_defined_vars());
    }

    public function store(CreateCustomerRequest $request)
    {
        $this->authorize('create', Customer::class);

        $customer = new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->password = Hash::make($request->password);
        $customer->role_id = $request->role;
        $customer->save();

        return redirect()->route('customers.index');
    }

    public function edit($id)
    {

        $customer = Customer::findOrFail($id);
        $this->authorizeUpdateCustomer($customer);

        $roles = Role::all();

        return view('customers.create', get_defined_vars());
    }

    public function update(UpdateCustomerRequest $request, $id)
    {

        $customer = Customer::find($id);
        $this->authorizeUpdateCustomer($customer);

        $customer->name = $request->name;
        $customer->email = $request->email;
        if ($request->password) {
            $customer->password = Hash::make($request->password);
        }
        $customer->save();

        return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
    }

    public function destroy($id)
    {


        $customer = Customer::find($id);
        $this->authorizeDeleteCustomer($customer);
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');
    }
}
