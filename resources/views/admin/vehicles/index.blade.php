@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Data Kendaraan</h1>
                <p class="text-sm text-gray-500">Daftar seluruh data kendaraan yang terdaftar di sistem.</p>
            </div>
            <a href="{{ route('admin.vehicles.create') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700">
                Tambah Kendaraan
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
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">No Polisi</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Jenis</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Merek</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Kapasitas (Kg)</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Status Kendaraan</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Status Aktif</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($vehicles as $vehicle)
                        <tr>
                            <td class="px-4 py-3 text-sm text-gray-800">{{ $vehicle->plate_number }}</td>
                            <td class="px-4 py-3 text-sm text-gray-800">{{ $vehicle->type }}</td>
                            <td class="px-4 py-3 text-sm text-gray-800">{{ $vehicle->brand ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-800">{{ $vehicle->capacity_kg ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-800">{{ $vehicle->status }}</td>
                            <td class="px-4 py-3 text-sm">
                                @if($vehicle->is_active)
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                                        Aktif
                                    </span>
                                @else
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700">
                                        Nonaktif
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm text-center space-x-2">
                                <a href="{{ route('admin.vehicles.show', $vehicle->id) }}"
                                   class="text-blue-600 hover:underline">Detail</a>

                                <a href="{{ route('admin.vehicles.edit', $vehicle->id) }}"
                                   class="text-yellow-600 hover:underline">Edit</a>

                                <form action="{{ route('admin.vehicles.destroy', $vehicle->id) }}"
                                      method="POST"
                                      class="inline-block"
                                      onsubmit="return confirm('Yakin ingin menonaktifkan data ini?')">
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
                            <td colspan="7" class="px-4 py-6 text-center text-sm text-gray-500">
                                Belum ada data kendaraan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $vehicles->links() }}
        </div>
    </div>
</div>
@endsection