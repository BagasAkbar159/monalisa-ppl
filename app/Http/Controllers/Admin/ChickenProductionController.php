<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChickenProduction;
use Illuminate\Http\Request;

class ChickenProductionController extends Controller
{
    public function index()
    {
        $productions = ChickenProduction::latest('production_date')->latest()->paginate(10);

        $totalChicken = ChickenProduction::sum('quantity_chicken');
        $totalWeight = ChickenProduction::sum('total_weight_kg');

        return view('admin.chicken-productions.index', compact(
            'productions',
            'totalChicken',
            'totalWeight'
        ));
    }

    public function create()
    {
        return view('admin.chicken-productions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'quantity_chicken' => ['required', 'integer', 'min:1'],
            'notes' => ['nullable', 'string'],
        ]);

        ChickenProduction::create([
            'production_date' => now()->toDateString(),
            'quantity_chicken' => $validated['quantity_chicken'],
            'total_weight_kg' => $validated['quantity_chicken'] * ChickenProduction::DEFAULT_WEIGHT_PER_CHICKEN,
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()
            ->route('admin.stock.index')
            ->with('success', 'Produksi ayam berhasil ditambahkan.');
    }

    public function show(ChickenProduction $chickenProduction)
    {
        return view('admin.chicken-productions.show', compact('chickenProduction'));
    }

    public function edit(ChickenProduction $chickenProduction)
    {
        return view('admin.chicken-productions.edit', compact('chickenProduction'));
    }

    public function update(Request $request, ChickenProduction $chickenProduction)
    {
        $validated = $request->validate([
            'quantity_chicken' => ['required', 'integer', 'min:1'],
            'notes' => ['nullable', 'string'],
        ]);

        $chickenProduction->update([
            'quantity_chicken' => $validated['quantity_chicken'],
            'total_weight_kg' => $validated['quantity_chicken'] * ChickenProduction::DEFAULT_WEIGHT_PER_CHICKEN,
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()
            ->route('admin.chicken-productions.index')
            ->with('success', 'Produksi ayam berhasil diperbarui.');
    }

    public function destroy(ChickenProduction $chickenProduction)
    {
        $chickenProduction->delete();

        return redirect()
            ->route('admin.chicken-productions.index')
            ->with('success', 'Produksi ayam berhasil dihapus.');
    }
}