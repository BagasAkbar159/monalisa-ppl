<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChickenPriceCatalog;
use Illuminate\Http\Request;

class ChickenPriceCatalogController extends Controller
{
    public function index()
    {
        $priceCatalogs = ChickenPriceCatalog::latest('effective_date')
            ->latest()
            ->paginate(10);

        return view('admin.chicken-price-catalogs.index', compact('priceCatalogs'));
    }

    public function create()
    {
        return view('admin.chicken-price-catalogs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'price_per_kg' => ['required', 'numeric', 'min:1'],
            'effective_date' => ['required', 'date'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $isActive = $request->boolean('is_active', true);

        if ($isActive) {
            ChickenPriceCatalog::where('is_active', true)->update(['is_active' => false]);
        }

        ChickenPriceCatalog::create([
            'price_per_kg' => $validated['price_per_kg'],
            'effective_date' => $validated['effective_date'],
            'is_active' => $isActive,
            'created_by' => auth()->id(),
        ]);

        return redirect()
            ->route('admin.chicken-price-catalogs.index')
            ->with('success', 'Harga ayam berhasil ditambahkan.');
    }

    public function show(ChickenPriceCatalog $chickenPriceCatalog)
    {
        return view('admin.chicken-price-catalogs.show', compact('chickenPriceCatalog'));
    }

    public function edit(ChickenPriceCatalog $chickenPriceCatalog)
    {
        return view('admin.chicken-price-catalogs.edit', compact('chickenPriceCatalog'));
    }

    public function update(Request $request, ChickenPriceCatalog $chickenPriceCatalog)
    {
        $validated = $request->validate([
            'price_per_kg' => ['required', 'numeric', 'min:1'],
            'effective_date' => ['required', 'date'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $isActive = $request->boolean('is_active', false);

        if ($isActive) {
            ChickenPriceCatalog::where('is_active', true)
                ->where('id', '!=', $chickenPriceCatalog->id)
                ->update(['is_active' => false]);
        }

        $chickenPriceCatalog->update([
            'price_per_kg' => $validated['price_per_kg'],
            'effective_date' => $validated['effective_date'],
            'is_active' => $isActive,
        ]);

        return redirect()
            ->route('admin.chicken-price-catalogs.index')
            ->with('success', 'Harga ayam berhasil diperbarui.');
    }

    public function destroy(ChickenPriceCatalog $chickenPriceCatalog)
    {
        $chickenPriceCatalog->delete();

        return redirect()
            ->route('admin.chicken-price-catalogs.index')
            ->with('success', 'Harga ayam berhasil dihapus.');
    }
}