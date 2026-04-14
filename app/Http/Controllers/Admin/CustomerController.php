<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class CustomerController extends Controller
{
    public function index(): View
    {
        $customers = Customer::with('user')->latest()->paginate(10);

        return view('admin.customers.index', compact('customers'));
    }

    public function create(): View
    {
        return view('admin.customers.create');
    }

    public function store(StoreCustomerRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'is_active' => $request->boolean('is_active', true),
            ]);

            $user->assignRole('customer');

            Customer::create([
                'user_id' => $user->id,
                'company_name' => $request->company_name,
                'address' => $request->address,
                'is_verified' => $request->boolean('is_verified', false),
                'verified_at' => $request->boolean('is_verified') ? now() : null,
                'is_active' => $request->boolean('is_active', true),
            ]);
        });

        return redirect()
            ->route('admin.customers.index')
            ->with('success', 'Data customer berhasil ditambahkan.');
    }

    public function show(Customer $customer): View
    {
        $customer->load('user');

        return view('admin.customers.show', compact('customer'));
    }

    public function edit(Customer $customer): View
    {
        $customer->load('user');

        return view('admin.customers.edit', compact('customer'));
    }

    public function update(UpdateCustomerRequest $request, Customer $customer): RedirectResponse
    {
        DB::transaction(function () use ($request, $customer) {
            $customer->user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'is_active' => $request->boolean('is_active', true),
            ]);

            if ($request->filled('password')) {
                $customer->user->update([
                    'password' => Hash::make($request->password),
                ]);
            }

            $customer->update([
                'company_name' => $request->company_name,
                'address' => $request->address,
                'is_verified' => $request->boolean('is_verified', false),
                'verified_at' => $request->boolean('is_verified')
                    ? ($customer->verified_at ?? now())
                    : null,
                'is_active' => $request->boolean('is_active', true),
            ]);
        });

        return redirect()
            ->route('admin.customers.index')
            ->with('success', 'Data customer berhasil diperbarui.');
    }

    public function destroy(Customer $customer): RedirectResponse
    {
        DB::transaction(function () use ($customer) {
            $customer->update([
                'is_active' => false,
            ]);

            $customer->user->update([
                'is_active' => false,
            ]);
        });

        return redirect()
            ->route('admin.customers.index')
            ->with('success', 'Data customer berhasil dinonaktifkan.');
    }
}