@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Stock Ayam</h1>
                <p class="text-sm text-gray-500">Monitoring stok ayam berdasarkan produksi dan transaksi.</p>
            </div>

            {{-- <a href="{{ route('admin.chicken-productions.create') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700">
                Tambah Produksi
            </a> --}}
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-5">
                <p class="text-sm text-blue-700">Total Stock Ayam</p>
                <p class="text-3xl font-bold text-blue-900">{{ $totalChicken }}</p>
                <p class="text-sm text-blue-600 mt-1">ekor</p>
            </div>

            <div class="bg-green-50 border border-green-200 rounded-lg p-5">
                <p class="text-sm text-green-700">Total Berat Stock</p>
                <p class="text-3xl font-bold text-green-900">{{ number_format($totalWeight ?? 0, 2, ',', '.') }}</p>
                <p class="text-sm text-green-600 mt-1">kg</p>
            </div>
        </div>

        <div class="flex gap-3 mb-6">
            <a href="{{ route('admin.stock.index', ['filter' => 'all']) }}"
               class="px-4 py-2 rounded-md border {{ $filter === 'all' ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-gray-700 border-gray-300' }}">
                Semua
            </a>

            <a href="{{ route('admin.stock.index', ['filter' => 'production']) }}"
               class="px-4 py-2 rounded-md border {{ $filter === 'production' ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-gray-700 border-gray-300' }}">
                Produksi
            </a>

            <a href="{{ route('admin.stock.index', ['filter' => 'transaction']) }}"
               class="px-4 py-2 rounded-md border {{ $filter === 'transaction' ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-gray-700 border-gray-300' }}">
                Transaksi
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Sumber</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Tanggal</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Jumlah Ayam</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Total Berat (kg)</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Dibuat Pada</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Catatan</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($stockRows as $row)
                        <tr>
                            <td class="px-4 py-3 text-sm text-gray-800">{{ $row['source'] }}</td>
                            <td class="px-4 py-3 text-sm text-gray-800">
                                {{ \Carbon\Carbon::parse($row['date'])->format('d-m-Y') }}
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-800">{{ $row['quantity_chicken'] }}</td>
                            <td class="px-4 py-3 text-sm text-gray-800">
                                {{ number_format($row['total_weight_kg'], 2, ',', '.') }}
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-800">
                                {{ $row['created_at'] ? \Carbon\Carbon::parse($row['created_at'])->format('d-m-Y H:i') : '-' }}
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-800">{{ $row['notes'] ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-6 text-center text-sm text-gray-500">
                                Belum ada data untuk filter ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection