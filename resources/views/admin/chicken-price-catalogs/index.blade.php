@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-slate-50 shadow rounded-lg p-6 border border-slate-200">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Katalog Harga Ayam</h1>
                <p class="text-sm text-gray-500">Daftar harga ayam per kilogram.</p>
            </div>
            <a href="{{ route('admin.chicken-price-catalogs.create') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700">
                Tambah Harga
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 rounded-md bg-green-100 border border-green-300 text-green-800 px-4 py-3">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Harga/Kg</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Tanggal Berlaku</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($priceCatalogs as $item)
                        <tr>
                            <td class="px-4 py-3 text-sm text-gray-800">
                                Rp {{ number_format($item->price_per_kg, 0, ',', '.') }}
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-800">
                                {{ $item->effective_date->format('d-m-Y') }}
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-800">
                                @if($item->is_active)
                                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">Aktif</span>
                                @else
                                    <span class="px-2 py-1 text-xs rounded-full bg-slate-100 text-slate-700">Nonaktif</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm text-center space-x-2">
                                <a href="{{ route('admin.chicken-price-catalogs.show', $item->id) }}" class="text-blue-600 hover:underline">Detail</a>
                                <a href="{{ route('admin.chicken-price-catalogs.edit', $item->id) }}" class="text-yellow-600 hover:underline">Edit</a>
                                <form action="{{ route('admin.chicken-price-catalogs.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus harga ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-6 text-center text-sm text-gray-500">
                                Belum ada data katalog harga.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $priceCatalogs->links() }}
        </div>
    </div>
</div>
@endsection