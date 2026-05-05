@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <h1 class="app-page-title">Data Driver</h1>
            <p class="app-page-subtitle">
                Kelola akun driver, dokumen SIM, kendaraan, dan status operasional pengiriman.
            </p>
        </div>

        <a href="{{ route('admin.drivers.create') }}" class="app-btn-accent">
            Tambah Driver
        </a>
    </div>

    <div class="grid gap-4 md:grid-cols-3">
        <div class="app-card">
            <div class="app-card-body">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold text-slate-500">Data Ditampilkan</p>
                        <p class="mt-3 text-3xl font-extrabold text-slate-900">
                            {{ number_format($drivers->count(), 0, ',', '.') }}
                        </p>
                        <p class="mt-1 text-xs text-slate-500">
                            Driver pada halaman ini
                        </p>
                    </div>

                    <div class="rounded-2xl bg-orange-50 p-3 text-orange-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 13h18l-2-5H5l-2 5Zm2 0v5m14-5v5M7 18h.01M17 18h.01" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="app-card overflow-hidden">
        <div class="border-b border-slate-200 px-6 py-5">
            <div class="flex flex-col justify-between gap-3 sm:flex-row sm:items-center">
                <div>
                    <h2 class="text-lg font-bold text-slate-900">Daftar Driver</h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Data driver terbaru ditampilkan berdasarkan waktu pendaftaran.
                    </p>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full table-fixed divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="w-[18%] px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                            Driver
                        </th>
                        <th class="w-[20%] px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                            Kontak
                        </th>
                        <th class="w-[15%] px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                            SIM
                        </th>
                        <th class="w-[17%] px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                            Kendaraan
                        </th>
                        <th class="w-[12%] px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                            Operasional
                        </th>
                        <th class="w-[8%] px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                            Akun
                        </th>
                        <th class="w-[10%] px-6 py-3 text-right text-xs font-bold uppercase tracking-wider text-slate-500">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse($drivers as $driver)
                        @php
                            $driverStatusClass = match ($driver->status) {
                                'available' => 'app-badge-green',
                                'on_delivery' => 'app-badge-orange',
                                'inactive' => 'app-badge-slate',
                                default => 'app-badge-slate',
                            };

                            $driverStatusLabel = match ($driver->status) {
                                'available' => 'Available',
                                'on_delivery' => 'On Delivery',
                                'inactive' => 'Inactive',
                                default => ucfirst($driver->status ?? '-'),
                            };
                        @endphp

                        <tr class="transition hover:bg-slate-50">
                            <td class="w-[18%] px-6 py-4">
                                <div class="min-w-0">
                                    <p class="truncate text-sm font-bold text-slate-900">
                                        {{ $driver->user->name ?? '-' }}
                                    </p>
                                    <p class="mt-1 text-xs text-slate-500">
                                        ID #{{ $driver->id }}
                                    </p>
                                </div>
                            </td>

                            <td class="w-[20%] px-6 py-4">
                                <div class="min-w-0">
                                    <p class="truncate text-sm font-semibold text-slate-900">
                                        {{ $driver->user->email ?? '-' }}
                                    </p>
                                    <p class="mt-1 truncate text-xs text-slate-500">
                                        {{ $driver->user->phone ?? '-' }}
                                    </p>
                                </div>
                            </td>

                            <td class="w-[15%] px-6 py-4">
                                <p class="truncate text-sm font-semibold text-slate-900">
                                    {{ $driver->license_number ?? '-' }}
                                </p>
                                <p class="mt-1 truncate text-xs text-slate-500">
                                    {{ $driver->license_type ?? '-' }}
                                </p>
                            </td>

                            <td class="w-[17%] px-6 py-4">
                                <p class="truncate text-sm font-semibold text-slate-900">
                                    {{ $driver->vehicle_type ?? '-' }}
                                </p>
                                <p class="mt-1 truncate text-xs text-slate-500">
                                    {{ $driver->plate_number ?? 'Plat belum diisi' }}
                                </p>
                            </td>

                            <td class="w-[12%] whitespace-nowrap px-6 py-4">
                                <span class="app-badge {{ $driverStatusClass }}">
                                    {{ $driverStatusLabel }}
                                </span>
                            </td>

                            <td class="w-[8%] whitespace-nowrap px-6 py-4">
                                @if($driver->is_active)
                                    <span class="app-badge app-badge-green">
                                        Aktif
                                    </span>
                                @else
                                    <span class="app-badge app-badge-red">
                                        Nonaktif
                                    </span>
                                @endif
                            </td>

                            <td class="w-[10%] whitespace-nowrap px-6 py-4 text-right">
                                <div class="flex justify-end gap-3">
                                    <a href="{{ route('admin.drivers.show', $driver) }}"
                                       class="app-badge app-badge-blue">
                                        Detail
                                    </a>

                                    <a href="{{ route('admin.drivers.edit', $driver) }}"
                                       class="app-badge app-badge-orange">
                                        Edit
                                    </a>

                                    @if($driver->is_active)
                                        <form action="{{ route('admin.drivers.destroy', $driver) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menonaktifkan driver ini?');">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="app-badge app-badge-red">
                                                Nonaktifkan
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-14 text-center">
                                <div class="mx-auto flex max-w-md flex-col items-center">
                                    <div class="rounded-2xl bg-slate-100 p-4 text-slate-500">
                                        <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 13h18l-2-5H5l-2 5Zm2 0v5m14-5v5M7 18h.01M17 18h.01" />
                                        </svg>
                                    </div>

                                    <h3 class="mt-4 text-base font-bold text-slate-900">
                                        Belum ada driver
                                    </h3>

                                    <p class="mt-1 text-sm text-slate-500">
                                        Tambahkan driver untuk mendukung proses pengiriman pesanan.
                                    </p>

                                    <a href="{{ route('admin.drivers.create') }}" class="app-btn-accent mt-5">
                                        Tambah Driver
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($drivers->hasPages())
            <div class="border-t border-slate-200 px-6 py-4">
                {{ $drivers->links() }}
            </div>
        @endif
    </div>
</div>
@endsection