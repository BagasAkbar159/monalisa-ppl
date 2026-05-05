@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-slate-50 shadow rounded-lg p-6 border border-slate-200">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Buat Pesanan</h1>

        @if ($errors->any())
            <div class="mb-4 rounded-md bg-red-100 border border-red-300 text-red-800 px-4 py-3">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('customer.orders.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700">Tanggal Pesanan</label>
                <input type="date" name="order_date" value="{{ old('order_date', now()->format('Y-m-d')) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Jumlah Ayam</label>
                <input type="number" name="quantity_chicken" value="{{ old('quantity_chicken') }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" min="1" required>
                <p class="mt-1 text-sm text-gray-500">
                    Berat dan harga akan dihitung otomatis berdasarkan pengaturan admin.
                </p>
            </div>

            <div class="bg-blue-50 border border-blue-200 rounded-md p-4 text-sm text-blue-800">
                Berat default per ekor ayam: <strong>1,8 kg</strong><br>
                Harga aktif saat ini: <strong>Rp {{ number_format($activePrice->price_per_kg, 0, ',', '.') }}/kg</strong>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Catatan</label>
                <textarea name="notes" rows="4"
                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('notes') }}</textarea>
            </div>

            <div class="flex items-center gap-3">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Simpan
                </button>
                <a href="{{ route('customer.orders.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection