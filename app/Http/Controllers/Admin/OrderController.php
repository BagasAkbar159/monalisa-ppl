<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChickenProduction;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private const OUTGOING_STATUSES = ['diproses', 'dikirim', 'selesai'];

    private function getAvailableChickenStock(?Order $ignoreOrder = null): int
    {
        $totalProduction = ChickenProduction::sum('quantity_chicken');

        $query = Order::whereIn('status', self::OUTGOING_STATUSES);

        if ($ignoreOrder) {
            $query->where('id', '!=', $ignoreOrder->id);
        }

        $totalOutgoing = $query->sum('quantity_chicken');

        return $totalProduction - $totalOutgoing;
    }

    private function shouldReduceStock(string $status): bool
    {
        return in_array($status, self::OUTGOING_STATUSES, true);
    }

    public function index()
    {
        $orders = Order::with('customer.user')
            ->latest('order_date')
            ->latest()
            ->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    public function create()
    {
        $customers = Customer::with('user')
            ->where('is_active', true)
            ->get();

        return view('admin.orders.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => ['required', 'exists:customers,id'],
            'order_date' => ['required', 'date'],
            'quantity_chicken' => ['required', 'integer', 'min:1'],
            'estimated_weight_kg' => ['required', 'numeric', 'min:0.01'],
            'price_per_kg' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'in:masuk,diproses,dikirim,selesai'],
            'notes' => ['nullable', 'string'],
        ]);

        $availableChicken = $this->getAvailableChickenStock();

        if (
            $this->shouldReduceStock($validated['status']) &&
            $validated['quantity_chicken'] > $availableChicken
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'quantity_chicken' => 'Stock ayam tidak mencukupi. Stock tersedia saat ini: ' . $availableChicken . ' ekor.',
                ]);
        }

        $validated['order_code'] = $this->generateOrderCode();
        $validated['estimated_total'] = $validated['estimated_weight_kg'] * $validated['price_per_kg'];
        $validated['created_by'] = auth()->id();

        Order::create($validated);

        return redirect()
            ->route('admin.orders.index')
            ->with('success', 'Pesanan berhasil dibuat.');
    }

    public function show(Order $order)
    {
        $order->load('customer.user', 'creator');

        return view('admin.orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        if ($order->status === 'dibatalkan') {
            return redirect()
                ->route('admin.orders.index')
                ->with('error', 'Pesanan yang sudah dibatalkan tidak dapat diedit.');
        }

        $customers = Customer::with('user')
            ->where('is_active', true)
            ->get();

        return view('admin.orders.edit', compact('order', 'customers'));
    }

    public function update(Request $request, Order $order)
    {
        if ($order->status === 'dibatalkan') {
            return redirect()
                ->route('admin.orders.index')
                ->with('error', 'Pesanan yang sudah dibatalkan tidak dapat diperbarui.');
        }

        $validated = $request->validate([
            'customer_id' => ['required', 'exists:customers,id'],
            'order_date' => ['required', 'date'],
            'quantity_chicken' => ['required', 'integer', 'min:1'],
            'estimated_weight_kg' => ['required', 'numeric', 'min:0.01'],
            'price_per_kg' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'in:masuk,diproses,dikirim,selesai,dibatalkan'],
            'notes' => ['nullable', 'string'],
        ]);

        $availableChicken = $this->getAvailableChickenStock($order);

        if (
            $this->shouldReduceStock($validated['status']) &&
            $validated['quantity_chicken'] > $availableChicken
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'quantity_chicken' => 'Stock ayam tidak mencukupi. Stock tersedia saat ini: ' . $availableChicken . ' ekor.',
                ]);
        }

        $validated['estimated_total'] = $validated['estimated_weight_kg'] * $validated['price_per_kg'];

        $order->update($validated);

        return redirect()
            ->route('admin.orders.index')
            ->with('success', 'Pesanan berhasil diperbarui.');
    }

    public function destroy(Order $order)
    {
        if ($order->status === 'selesai') {
            return redirect()
                ->route('admin.orders.index')
                ->with('error', 'Pesanan yang sudah selesai tidak dapat dibatalkan.');
        }

        if ($order->status === 'dibatalkan') {
            return redirect()
                ->route('admin.orders.index')
                ->with('error', 'Pesanan ini sudah dibatalkan sebelumnya.');
        }

        $order->update([
            'status' => 'dibatalkan',
        ]);

        return redirect()
            ->route('admin.orders.index')
            ->with('success', 'Pesanan berhasil dibatalkan.');
    }

    private function generateOrderCode(): string
    {
        $datePart = now()->format('Ymd');
        $countToday = Order::whereDate('created_at', now()->toDateString())->count() + 1;
        $sequence = str_pad((string) $countToday, 3, '0', STR_PAD_LEFT);

        return 'ORD-' . $datePart . '-' . $sequence;
    }
}
