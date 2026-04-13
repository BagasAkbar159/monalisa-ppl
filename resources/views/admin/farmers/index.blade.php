@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Data Peternak</h1>
                <p class="text-sm text-gray-500">Daftar seluruh data peternak yang terdaftar di sistem.</p>
            </div>
            <a href="{{ route('admin.farmers.create') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700">
                Tambah Peternak
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
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Kode</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Nama</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Alamat</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">No HP</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($farmers as $farmer)
                        <tr>
                            <td class="px-4 py-3 text-sm text-gray-800">{{ $farmer->code }}</td>
                            <td class="px-4 py-3 text-sm text-gray-800">{{ $farmer->name }}</td>
                            <td class="px-4 py-3 text-sm text-gray-800">{{ $farmer->address ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-800">{{ $farmer->phone ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm">
                                @if($farmer->is_active)
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
                                <a href="{{ route('admin.farmers.show', $farmer->id) }}"
                                   class="text-blue-600 hover:underline">Detail</a>

                                <a href="{{ route('admin.farmers.edit', $farmer->id) }}"
                                   class="text-yellow-600 hover:underline">Edit</a>

                                <form action="{{ route('admin.farmers.destroy', $farmer->id) }}"
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
                                Belum ada data peternak.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $farmers->links() }}
        </div>
    </div>
</div>
@endsection