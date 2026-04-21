@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Detail Produksi Ayam</h1>

        <div class="space-y-4">
            <div>
                <p class="text-sm text-gray-500">Tanggal Produksi</p>
                <p class="text-lg font-semibold text-gray-800">
                    {{ \Carbon\Carbon::parse($chickenProduction->production_date)->format('d-m-Y') }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Jumlah Ayam</p>
                <p class="text-lg font-semibold text-gray-800">
                    {{ $chickenProduction->quantity_chicken }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Total Berat Ayam (kg)</p>
                <p class="text-lg font-semibold text-gray-800">
                    {{ number_format($chickenProduction->total_weight_kg, 2, ',', '.') }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Dibuat Pada</p>
                <p class="text-lg font-semibold text-gray-800">
                    {{ $chickenProduction->created_at ? $chickenProduction->created_at->format('d-m-Y H:i') : '-' }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Catatan</p>
                <p class="text-lg text-gray-800">
                    {{ $chickenProduction->notes ?? '-' }}
                </p>
            </div>
        </div>

        <div class="mt-6 flex gap-3">
            <a href="{{ route('admin.chicken-productions.edit', $chickenProduction->id) }}"
               class="px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600">
                Edit
            </a>

            <a href="{{ route('admin.chicken-productions.index') }}"
               class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                Kembali
            </a>
        </div>
    </div>
</div>
@endsection