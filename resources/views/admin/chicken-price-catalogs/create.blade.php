@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-slate-50 shadow rounded-lg p-6 border border-slate-200">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Tambah Harga Ayam</h1>

        @if ($errors->any())
            <div class="mb-4 rounded-md bg-red-100 border border-red-300 text-red-800 px-4 py-3">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.chicken-price-catalogs.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700">Harga per Kg</label>
                <input type="number" step="0.01" name="price_per_kg" value="{{ old('price_per_kg') }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" min="1" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Tanggal Berlaku</label>
                <input type="date" name="effective_date" value="{{ old('effective_date', now()->format('Y-m-d')) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" name="is_active" value="1" checked>
                <label class="text-sm text-gray-700">Jadikan harga aktif</label>
            </div>

            <div class="flex items-center gap-3">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Simpan
                </button>
                <a href="{{ route('admin.chicken-price-catalogs.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection