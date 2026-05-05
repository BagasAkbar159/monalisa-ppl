@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-slate-50 shadow rounded-lg p-6 border border-slate-200">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Pesanan</h1>

        @if ($errors->any())
            <div class="mb-4 rounded-md bg-red-100 border border-red-300 text-red-800 px-4 py-3">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700">Customer</label>
                <select name="customer_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    <option value="">-- Pilih Customer --</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" {{ old('customer_id', $order->customer_id) == $customer->id ? 'selected' : '' }}>
                            {{ $customer->user->name ?? '-' }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Tanggal Pesanan</label>
                <input type="date" name="order_date"
                       value="{{ old('order_date', $order->order_date->format('Y-m-d')) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Jumlah Ayam</label>
                <input type="number" name="quantity_chicken"
                       value="{{ old('quantity_chicken', $order->quantity_chicken) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" min="1" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Estimasi Berat (kg)</label>
                <input type="number" step="0.01" name="estimated_weight_kg"
                       value="{{ old('estimated_weight_kg', $order->estimated_weight_kg) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" min="0.01" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Harga per Kg</label>
                <input type="number" step="0.01" name="price_per_kg"
                       value="{{ old('price_per_kg', $order->price_per_kg) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" min="0" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    <option value="masuk" {{ old('status', $order->status) == 'masuk' ? 'selected' : '' }}>Masuk</option>
                    <option value="diproses" {{ old('status', $order->status) == 'diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="dikirim" {{ old('status', $order->status) == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                    <option value="selesai" {{ old('status', $order->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Catatan</label>
                <textarea name="notes" rows="4"
                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('notes', $order->notes) }}</textarea>
            </div>

            <div class="flex items-center gap-3">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Update
                </button>
                <a href="{{ route('admin.orders.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection