<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFarmerRequest;
use App\Http\Requests\UpdateFarmerRequest;
use App\Models\Farmer;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FarmerController extends Controller
{
    public function index(): View
    {
        $farmers = Farmer::latest()->paginate(10);

        return view('admin.farmers.index', compact('farmers'));
    }

    public function create(): View
    {
        return view('admin.farmers.create');
    }

    public function store(StoreFarmerRequest $request): RedirectResponse
    {
        Farmer::create([
            'code' => $request->code,
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()
            ->route('admin.farmers.index')
            ->with('success', 'Data peternak berhasil ditambahkan.');
    }

    public function show(Farmer $farmer): View
    {
        return view('admin.farmers.show', compact('farmer'));
    }

    public function edit(Farmer $farmer): View
    {
        return view('admin.farmers.edit', compact('farmer'));
    }

    public function update(UpdateFarmerRequest $request, Farmer $farmer): RedirectResponse
    {
        $farmer->update([
            'code' => $request->code,
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()
            ->route('admin.farmers.index')
            ->with('success', 'Data peternak berhasil diperbarui.');
    }

    public function destroy(Farmer $farmer): RedirectResponse
    {
        $farmer->update([
            'is_active' => false,
        ]);

        return redirect()
            ->route('admin.farmers.index')
            ->with('success', 'Data peternak berhasil dinonaktifkan.');
    }
}