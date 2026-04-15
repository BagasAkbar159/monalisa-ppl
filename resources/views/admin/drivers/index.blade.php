@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Data Driver</h1>
                <p class="text-sm text-gray-500">Daftar seluruh data driver yang terdaftar di sistem.</p>
            </div>
            <a href="{{ route('admin.drivers.create') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700">
                Tambah Driver
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
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Nama</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Email</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">No HP</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">No SIM</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Jenis SIM</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Status Driver</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Status Aktif</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($drivers as $driver)
                        <tr>
                            <td class="px-4 py-3 text-sm text-gray-800">{{ $driver->user->name }}</td>
                            <td class="px-4 py-3 text-sm text-gray-800">{{ $driver->user->email }}</td>
                            <td class="px-4 py-3 text-sm text-gray-800">{{ $driver->user->phone ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-800">{{ $driver->license_number }}</td>
                            <td class="px-4 py-3 text-sm text-gray-800">{{ $driver->license_type ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-800">
                                @if($driver->status === 'available')
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                                        Available
                                    </span>
                                @elseif($driver->status === 'on_delivery')
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-700">
                                        On Delivery
                                    </span>
                                @else
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-700">
                                        Inactive
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm">
                                @if($driver->is_active)
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
                                <a href="{{ route('admin.drivers.show', $driver->id) }}"
                                   class="text-blue-600 hover:underline">Detail</a>

                                <a href="{{ route('admin.drivers.edit', $driver->id) }}"
                                   class="text-yellow-600 hover:underline">Edit</a>

                                <form action="{{ route('admin.drivers.destroy', $driver->id) }}"
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
                            <td colspan="8" class="px-4 py-6 text-center text-sm text-gray-500">
                                Belum ada data driver.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $drivers->links() }}
        </div>
    </div>
</div>
@endsection