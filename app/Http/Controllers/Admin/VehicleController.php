<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;
use App\Models\Vehicle;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class VehicleController extends Controller
{
    public function index(): View
    {
        $vehicles = Vehicle::latest()->paginate(10);

        return view('admin.vehicles.index', compact('vehicles'));
    }

    public function create(): View
    {
        return view('admin.vehicles.create');
    }

    public function store(StoreVehicleRequest $request): RedirectResponse
    {
        Vehicle::create([
            'plate_number' => $request->plate_number,
            'type' => $request->type,
            'brand' => $request->brand,
            'capacity_kg' => $request->capacity_kg,
            'status' => $request->status,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()
            ->route('admin.vehicles.index')
            ->with('success', 'Data kendaraan berhasil ditambahkan.');
    }

    public function show(Vehicle $vehicle): View
    {
        return view('admin.vehicles.show', compact('vehicle'));
    }

    public function edit(Vehicle $vehicle): View
    {
        return view('admin.vehicles.edit', compact('vehicle'));
    }

    public function update(UpdateVehicleRequest $request, Vehicle $vehicle): RedirectResponse
    {
        $vehicle->update([
            'plate_number' => $request->plate_number,
            'type' => $request->type,
            'brand' => $request->brand,
            'capacity_kg' => $request->capacity_kg,
            'status' => $request->status,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()
            ->route('admin.vehicles.index')
            ->with('success', 'Data kendaraan berhasil diperbarui.');
    }

    public function destroy(Vehicle $vehicle): RedirectResponse
    {
        $vehicle->update([
            'is_active' => false,
        ]);

        return redirect()
            ->route('admin.vehicles.index')
            ->with('success', 'Data kendaraan berhasil dinonaktifkan.');
    }
}