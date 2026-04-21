@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Produksi Ayam</h1>
                <p class="text-sm text-gray-500">Data penambahan stok ayam hasil produksi.</p>
            </div>
            <a href="{{ route('admin.chicken-productions.create') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700">
                Tambah Produksi
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 rounded-md bg-green-100 border border-green-300 text-green-800 px-4 py-3">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div class="bg-gray-50 border rounded-lg p-4">
                <p class="text-sm text-gray-500">Total Jumlah Ayam</p>
                <p class="text-2xl font-bold text-gray-800">{{ $totalChicken }}</p>
            </div>
            <div class="bg-gray-50 border rounded-lg p-4">
                <p class="text-sm text-gray-500">Total Berat Ayam</p>
                <p class="text-2xl font-bold text-gray-800">{{ number_format($totalWeight ?? 0, 2, ',', '.') }} kg</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Tanggal Produksi</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Jumlah Ayam</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Total Berat (kg)</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Dibuat Pada</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Catatan</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($productions as $production)
                        <tr>
                            <td class="px-4 py-3 text-sm text-gray-800">
                                {{ \Carbon\Carbon::parse($production->production_date)->format('d-m-Y') }}
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-800">
                                {{ $production->quantity_chicken }}
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-800">
                                {{ number_format($production->total_weight_kg, 2, ',', '.') }}
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-800">
                                {{ $production->created_at ? $production->created_at->format('d-m-Y H:i') : '-' }}
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-800">
                                {{ $production->notes ?? '-' }}
                            </td>
                            <td class="px-4 py-3 text-sm text-center space-x-2">
                                <a href="{{ route('admin.chicken-productions.show', $production->id) }}"
                                   class="text-blue-600 hover:underline">Detail</a>

                                <a href="{{ route('admin.chicken-productions.edit', $production->id) }}"
                                   class="text-yellow-600 hover:underline">Edit</a>

                                <form action="{{ route('admin.chicken-productions.destroy', $production->id) }}"
                                      method="POST"
                                      class="inline-block"
                                      onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-6 text-center text-sm text-gray-500">
                                Belum ada data produksi ayam.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $productions->links() }}
        </div>
    </div>
</div>
@endsection