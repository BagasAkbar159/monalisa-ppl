<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\ChickenPriceCatalog;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private const DEFAULT_WEIGHT_PER_CHICKEN = 1.8;

    public function index()
    {
        $customer = auth()->user()->customer;

        $orders = Order::where('customer_id', $customer->id)
            ->latest('order_date')
            ->latest()
            ->paginate(10);

        return view('customer.orders.index', compact('orders'));
    }

    public function create()
    {
        $activePrice = ChickenPriceCatalog::getActive();

        if (!$activePrice) {
            return redirect()
                ->route('customer.orders.index')
                ->with('error', 'Harga ayam belum diatur oleh admin.');
        }

        return view('customer.orders.create', compact('activePrice'));
    }

    public function store(Request $request)
    {
        $customer = auth()->user()->customer;
        $activePrice = ChickenPriceCatalog::getActive();

        if (!$activePrice) {
            return redirect()
                ->route('customer.orders.index')
                ->with('error', 'Harga ayam belum diatur oleh admin.');
        }

        $validated = $request->validate([
            'order_date' => ['required', 'date'],
            'quantity_chicken' => ['required', 'integer', 'min:1'],
            'notes' => ['nullable', 'string'],
        ]);

        $estimatedWeight = $validated['quantity_chicken'] * self::DEFAULT_WEIGHT_PER_CHICKEN;
        $pricePerKg = $activePrice->price_per_kg;
        $estimatedTotal = $estimatedWeight * $pricePerKg;

        Order::create([
            'customer_id' => $customer->id,
            'chicken_price_catalog_id' => $activePrice->id,
            'order_code' => $this->generateOrderCode(),
            'order_date' => $validated['order_date'],
            'quantity_chicken' => $validated['quantity_chicken'],
            'estimated_weight_kg' => $estimatedWeight,
            'price_per_kg' => $pricePerKg,
            'estimated_total' => $estimatedTotal,
            'status' => 'masuk',
            'notes' => $validated['notes'] ?? null,
            'created_by' => auth()->id(),
        ]);

        return redirect()
            ->route('customer.orders.index')
            ->with('success', 'Pesanan berhasil dibuat.');
    }

    public function show(Order $order)
    {
        $customer = auth()->user()->customer;

        if ($order->customer_id !== $customer->id) {
            abort(403, 'Anda tidak memiliki akses ke pesanan ini.');
        }

        return view('customer.orders.show', compact('order'));
    }

    private function generateOrderCode(): string
    {
        $datePart = now()->format('Ymd');
        $countToday = Order::whereDate('created_at', now()->toDateString())->count() + 1;
        $sequence = str_pad((string) $countToday, 3, '0', STR_PAD_LEFT);

        return 'ORD-' . $datePart . '-' . $sequence;
    }
}