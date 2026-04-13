<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Farmer;
use Illuminate\Http\Request;

class FarmerController extends Controller
{
    public function index()
    {
        $farmers = Farmer::latest()->paginate(10);
        return view('admin.farmers.index', compact('farmers'));
    }

    public function create()
    {
        return view('admin.farmers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:farmers,code',
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'is_active' => 'required|boolean',
        ]);

        Farmer::create($validated);

        return redirect()
            ->route('admin.farmers.index')
            ->with('success', 'Data peternak berhasil ditambahkan.');
    }

    public function show(Farmer $farmer)
    {
        return view('admin.farmers.show', compact('farmer'));
    }

    public function edit(Farmer $farmer)
    {
        return view('admin.farmers.edit', compact('farmer'));
    }

    public function update(Request $request, Farmer $farmer)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:farmers,code,' . $farmer->id,
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'is_active' => 'required|boolean',
        ]);

        $farmer->update($validated);

        return redirect()
            ->route('admin.farmers.index')
            ->with('success', 'Data peternak berhasil diperbarui.');
    }

    public function destroy(Farmer $farmer)
    {
        $farmer->delete();

        return redirect()
            ->route('admin.farmers.index')
            ->with('success', 'Data peternak berhasil dihapus.');
    }
}