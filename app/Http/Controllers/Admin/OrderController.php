<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\ChickenProduction;

class OrderController extends Controller
{
    private function getAvailableChickenStock(?Order $ignoreOrder = null): int
    {
        $totalProduction = ChickenProduction::sum('quantity_chicken');

        $outgoingStatuses = ['diproses', 'dikirim', 'selesai'];

        $query = Order::whereIn('status', $outgoingStatuses);

        if ($ignoreOrder) {
            $query->where('id', '!=', $ignoreOrder->id);
        }

        $totalOutgoing = $query->sum('quantity_chicken');

        return $totalProduction - $totalOutgoing;
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

        $validated['order_code'] = $this->generateOrderCode();
        $validated['estimated_total'] = $validated['estimated_weight_kg'] * $validated['price_per_kg'];
        $validated['created_by'] = auth()->id();

        Order::create($validated);
        $availableChicken = $this->getAvailableChickenStock();

        if (in_array($validated['status'], ['diproses', 'dikirim', 'selesai']) &&
            $validated['quantity_chicken'] > $availableChicken) {
            return back()
                ->withInput()
                ->withErrors([
                    'quantity_chicken' => 'Stock ayam tidak mencukupi untuk pesanan ini.',
                ]);
        }

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
        $customers = Customer::with('user')
            ->where('is_active', true)
            ->get();

        return view('admin.orders.edit', compact('order', 'customers'));
    }

    public function update(Request $request, Order $order)
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

        $validated['estimated_total'] = $validated['estimated_weight_kg'] * $validated['price_per_kg'];

        $order->update($validated);

        $availableChicken = $this->getAvailableChickenStock($order);
        
        if (in_array($validated['status'], ['diproses', 'dikirim', 'selesai']) &&
            $validated['quantity_chicken'] > $availableChicken) {
            return back()
                ->withInput()
                ->withErrors([
                    'quantity_chicken' => 'Stock ayam tidak mencukupi untuk pesanan ini.',
                ]);
        }
        
        return redirect()
            ->route('admin.orders.index')
            ->with('success', 'Pesanan berhasil diperbarui.');
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()
            ->route('admin.orders.index')
            ->with('success', 'Pesanan berhasil dihapus.');
    }

    private function generateOrderCode(): string
    {
        $datePart = now()->format('Ymd');
        $countToday = Order::whereDate('created_at', now()->toDateString())->count() + 1;
        $sequence = str_pad((string) $countToday, 3, '0', STR_PAD_LEFT);

        return 'ORD-' . $datePart . '-' . $sequence;
    }

}
