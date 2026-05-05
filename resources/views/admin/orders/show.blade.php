@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-slate-50 shadow rounded-lg p-6 border border-slate-200">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Detail Pesanan</h1>

        <div class="space-y-4">
            <div>
                <p class="text-sm text-gray-500">Kode Pesanan</p>
                <p class="text-lg font-semibold text-gray-800">{{ $order->order_code }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Tanggal Pesanan</p>
                <p class="text-lg font-semibold text-gray-800">{{ $order->order_date->format('d-m-Y') }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Customer</p>
                <p class="text-lg font-semibold text-gray-800">{{ $order->customer->user->name ?? '-' }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Jumlah Ayam</p>
                <p class="text-lg font-semibold text-gray-800">{{ $order->quantity_chicken }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Estimasi Berat</p>
                <p class="text-lg font-semibold text-gray-800">{{ number_format($order->estimated_weight_kg, 2, ',', '.') }} kg</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Harga per Kg</p>
                <p class="text-lg font-semibold text-gray-800">Rp {{ number_format($order->price_per_kg, 0, ',', '.') }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Estimasi Total</p>
                <p class="text-lg font-semibold text-gray-800">Rp {{ number_format($order->estimated_total, 0, ',', '.') }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Status</p>
                <p class="text-lg font-semibold text-gray-800">{{ ucfirst($order->status) }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Catatan</p>
                <p class="text-lg text-gray-800">{{ $order->notes ?? '-' }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Dibuat Oleh</p>
                <p class="text-lg text-gray-800">{{ $order->creator->name ?? '-' }}</p>
            </div>
        </div>

        <div class="mt-6 flex gap-3">
            <a href="{{ route('admin.orders.edit', $order->id) }}"
               class="px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600">
                Edit
            </a>

            <a href="{{ route('admin.orders.index') }}"
               class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                Kembali
            </a>
        </div>
    </div>
</div>
@endsection