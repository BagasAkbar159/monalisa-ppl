<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDriverRequest;
use App\Http\Requests\UpdateDriverRequest;
use App\Models\Driver;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class DriverController extends Controller
{
    public function index(): View
    {
        $drivers = Driver::with('user')->latest()->paginate(10);

        return view('admin.drivers.index', compact('drivers'));
    }

    public function create(): View
    {
        return view('admin.drivers.create');
    }

    public function store(StoreDriverRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'is_active' => $request->boolean('is_active', true),
            ]);

            $user->assignRole('driver');

            Driver::create([
                'user_id' => $user->id,
                'license_number' => $request->license_number,
                'license_type' => $request->license_type,
                'license_expiry_date' => $request->license_expiry_date,
                'address' => $request->address,
                'status' => $request->status,
                'notes' => $request->notes,
                'is_active' => $request->boolean('is_active', true),
            ]);
        });

        return redirect()
            ->route('admin.drivers.index')
            ->with('success', 'Data driver berhasil ditambahkan.');
    }

    public function show(Driver $driver): View
    {
        $driver->load('user');

        return view('admin.drivers.show', compact('driver'));
    }

    public function edit(Driver $driver): View
    {
        $driver->load('user');

        return view('admin.drivers.edit', compact('driver'));
    }

    public function update(UpdateDriverRequest $request, Driver $driver): RedirectResponse
    {
        DB::transaction(function () use ($request, $driver) {
            $driver->user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'is_active' => $request->boolean('is_active', true),
            ]);

            if ($request->filled('password')) {
                $driver->user->update([
                    'password' => Hash::make($request->password),
                ]);
            }

            $driver->update([
                'license_number' => $request->license_number,
                'license_type' => $request->license_type,
                'license_expiry_date' => $request->license_expiry_date,
                'address' => $request->address,
                'status' => $request->status,
                'notes' => $request->notes,
                'is_active' => $request->boolean('is_active', true),
            ]);
        });

        return redirect()
            ->route('admin.drivers.index')
            ->with('success', 'Data driver berhasil diperbarui.');
    }

    public function destroy(Driver $driver): RedirectResponse
    {
        DB::transaction(function () use ($driver) {
            $driver->update([
                'is_active' => false,
                'status' => 'inactive',
            ]);

            $driver->user->update([
                'is_active' => false,
            ]);
        });

        return redirect()
            ->route('admin.drivers.index')
            ->with('success', 'Data driver berhasil dinonaktifkan.');
    }
}