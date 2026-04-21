<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChickenProduction;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'all');

        $productionQuery = ChickenProduction::query();

        $totalChickenProduction = ChickenProduction::sum('quantity_chicken');
        $totalWeightProduction = ChickenProduction::sum('total_weight_kg');

        // Untuk sekarang transaksi belum ada, jadi stok masih full dari produksi
        $totalChicken = $totalChickenProduction;
        $totalWeight = $totalWeightProduction;

        if ($filter === 'production' || $filter === 'all') {
            $stockRows = $productionQuery
                ->latest('production_date')
                ->latest()
                ->get()
                ->map(function ($item) {
                    return [
                        'source' => 'Produksi',
                        'date' => $item->production_date,
                        'quantity_chicken' => $item->quantity_chicken,
                        'total_weight_kg' => $item->total_weight_kg,
                        'notes' => $item->notes,
                        'created_at' => $item->created_at,
                    ];
                });
        } else {
            $stockRows = collect();
        }

        // Placeholder untuk transaksi, karena modul transaksi belum dibuat
        if ($filter === 'transaction') {
            $stockRows = collect();
        }

        return view('admin.stock.index', compact(
            'filter',
            'totalChicken',
            'totalWeight',
            'stockRows'
        ));
    }
}