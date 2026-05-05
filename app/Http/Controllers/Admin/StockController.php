<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChickenProduction;
use App\Models\Order;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'all');

        $totalChickenProduction = ChickenProduction::sum('quantity_chicken');
        $totalWeightProduction = ChickenProduction::sum('total_weight_kg');

        $outgoingStatuses = ['diproses', 'dikirim', 'selesai'];

        $totalChickenOutgoing = Order::whereIn('status', $outgoingStatuses)->sum('quantity_chicken');
        $totalWeightOutgoing = Order::whereIn('status', $outgoingStatuses)->sum('estimated_weight_kg');

        $availableChicken = $totalChickenProduction - $totalChickenOutgoing;
        $availableWeight = $totalWeightProduction - $totalWeightOutgoing;

        $stockRows = collect();

        if ($filter === 'all' || $filter === 'production') {
            $productionRows = ChickenProduction::latest('production_date')
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

            $stockRows = $stockRows->merge($productionRows);
        }

        if ($filter === 'all' || $filter === 'transaction') {
            $transactionRows = Order::whereIn('status', $outgoingStatuses)
                ->latest('order_date')
                ->latest()
                ->get()
                ->map(function ($item) {
                    return [
                        'source' => 'Transaksi',
                        'date' => $item->order_date,
                        'quantity_chicken' => -1 * $item->quantity_chicken,
                        'total_weight_kg' => -1 * $item->estimated_weight_kg,
                        'notes' => 'Order: ' . $item->order_code . ' (' . ucfirst($item->status) . ')',
                        'created_at' => $item->created_at,
                    ];
                });

            $stockRows = $stockRows->merge($transactionRows);
        }

        $stockRows = $stockRows->sortByDesc(function ($row) {
            return $row['created_at'];
        })->values();

        return view('admin.stock.index', compact(
            'filter',
            'totalChickenProduction',
            'totalWeightProduction',
            'totalChickenOutgoing',
            'totalWeightOutgoing',
            'availableChicken',
            'availableWeight',
            'stockRows'
        ));
    }
}