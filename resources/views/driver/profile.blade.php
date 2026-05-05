@extends('layouts.app')

@section('content')
@php
    $user = auth()->user();
    $driver = $user->driver;

    $status = $driver->status ?? 'inactive';

    $statusLabel = match ($status) {
        'available' => 'Available',
        'on_delivery' => 'On Delivery',
        'inactive' => 'Inactive',
        default => ucfirst($status),
    };

    $statusClass = match ($status) {
        'available' => 'app-badge-green',
        'on_delivery' => 'app-badge-orange',
        'inactive' => 'app-badge-slate',
        default => 'app-badge-slate',
    };
@endphp

<div class="space-y-6">
    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <h1 class="app-page-title">Profil Driver</h1>
            <p class="app-page-subtitle">
                Lihat informasi akun, data SIM, kendaraan, dan status operasional driver.
            </p>
        </div>

        <div class="flex flex-wrap gap-2">
            <a href="{{ route('profile.edit') }}" class="app-btn-secondary">
                Edit Akun
            </a>

            <a href="{{ route('driver.dashboard') }}" class="app-btn-secondary">
                Dashboard
            </a>
        </div>
    </div>

    @if (! $driver)
        <div class="rounded-2xl border border-orange-200 bg-orange-50 p-5 text-orange-900">
            <p class="text-sm font-bold">Data driver belum tersedia</p>
            <p class="mt-2 text-sm leading-6">
                Akun ini memiliki role driver, tetapi belum memiliki data driver yang terhubung.
                Hubungi admin untuk melengkapi data driver.
            </p>
        </div>
    @endif

    <div class="grid gap-4 md:grid-cols-3">
        <div class="app-card">
            <div class="app-card-body">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold text-slate-500">Status Operasional</p>

                        <div class="mt-4">
                            <span class="app-badge {{ $statusClass }}">
                                {{ $statusLabel }}
                            </span>
                        </div>

                        <p class="mt-3 text-xs text-slate-500">
                            Status driver saat ini
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

        <div class="app-card">
            <div class="app-card-body">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold text-slate-500">Status Akun</p>

                        <div class="mt-4">
                            @if ($driver?->is_active)
                                <span class="app-badge app-badge-green">
                                    Aktif
                                </span>
                            @else
                                <span class="app-badge app-badge-red">
                                    Nonaktif
                                </span>
                            @endif
                        </div>

                        <p class="mt-3 text-xs text-slate-500">
                            Status akun driver
                        </p>
                    </div>

                    <div class="rounded-2xl bg-emerald-50 p-3 text-emerald-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M12 3l7.5 4.5v5.25C19.5 17.25 16.5 21 12 22c-4.5-1-7.5-4.75-7.5-9.25V7.5L12 3Z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-card border-[#163A63]/20 bg-gradient-to-br from-white to-blue-50">
            <div class="app-card-body">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold text-slate-500">Kendaraan</p>
                        <p class="mt-3 text-2xl font-extrabold text-[#163A63]">
                            {{ $driver->vehicle_type ?? '-' }}
                        </p>
                        <p class="mt-1 text-xs text-slate-500">
                            {{ $driver->plate_number ?? 'Plat nomor belum diisi' }}
                        </p>
                    </div>

                    <div class="rounded-2xl bg-[#163A63] p-3 text-white">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16V8a2 2 0 0 1 2-2h8l4 4v6M4 16h16M7 16a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm10 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-3">
        <div class="app-card lg:col-span-2">
            <div class="app-card-body">
                <div class="mb-6">
                    <h2 class="text-lg font-bold text-slate-900">Informasi Akun</h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Data akun login driver yang digunakan untuk masuk ke sistem MONALISA.
                    </p>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-500">
                            Nama
                        </p>
                        <p class="mt-2 text-sm font-bold text-slate-900">
                            {{ $user->name ?? '-' }}
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-500">
                            Email
                        </p>
                        <p class="mt-2 truncate text-sm font-bold text-slate-900">
                            {{ $user->email ?? '-' }}
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-500">
                            Nomor Telepon
                        </p>
                        <p class="mt-2 text-sm font-bold text-slate-900">
                            {{ $user->phone ?? '-' }}
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-500">
                            Role
                        </p>
                        <p class="mt-2 text-sm font-bold text-slate-900">
                            Driver
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-card">
            <div class="app-card-body">
                <h2 class="text-lg font-bold text-slate-900">Catatan Akses</h2>
                <p class="mt-2 text-sm leading-6 text-slate-500">
                    Driver dapat mengubah informasi akun dasar melalui halaman profil akun.
                    Data SIM, kendaraan, dan status operasional dikelola oleh admin.
                </p>

                <a href="{{ route('profile.edit') }}" class="app-btn-primary mt-5 w-full">
                    Edit Akun Login
                </a>
            </div>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-3">
        <div class="app-card lg:col-span-2">
            <div class="app-card-body">
                <div class="mb-6">
                    <h2 class="text-lg font-bold text-slate-900">Informasi Driver</h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Data operasional driver yang digunakan untuk kebutuhan pengiriman.
                    </p>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-500">
                            Alamat
                        </p>
                        <p class="mt-2 text-sm font-bold text-slate-900">
                            {{ $driver->address ?? '-' }}
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-500">
                            Nomor SIM
                        </p>
                        <p class="mt-2 text-sm font-bold text-slate-900">
                            {{ $driver->license_number ?? '-' }}
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-500">
                            Jenis SIM
                        </p>
                        <p class="mt-2 text-sm font-bold text-slate-900">
                            {{ $driver->license_type ?? '-' }}
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-500">
                            Masa Berlaku SIM
                        </p>
                        <p class="mt-2 text-sm font-bold text-slate-900">
                            {{ $driver?->license_expiry_date ? $driver->license_expiry_date->format('d M Y') : '-' }}
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-500">
                            Jenis Kendaraan
                        </p>
                        <p class="mt-2 text-sm font-bold text-slate-900">
                            {{ $driver->vehicle_type ?? '-' }}
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-500">
                            Plat Nomor
                        </p>
                        <p class="mt-2 text-sm font-bold text-slate-900">
                            {{ $driver->plate_number ?? '-' }}
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5 sm:col-span-2">
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-500">
                            Catatan Admin
                        </p>
                        <p class="mt-2 whitespace-pre-line text-sm leading-6 text-slate-700">
                            {{ $driver->notes ?? '-' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="app-card border-[#163A63]/20 bg-gradient-to-br from-white to-blue-50">
                <div class="app-card-body">
                    <h2 class="text-lg font-bold text-slate-900">Pengiriman</h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Modul pengiriman driver belum aktif penuh.
                    </p>

                    <div class="mt-6 rounded-2xl bg-[#102C4D] p-5 text-white">
                        <p class="text-sm font-semibold text-orange-200">Coming Soon</p>
                        <p class="mt-2 text-2xl font-extrabold">
                            Shipment Module
                        </p>
                        <p class="mt-3 text-sm leading-6 text-slate-200">
                            Nantinya driver dapat melihat daftar pengiriman, detail pesanan, dan status perjalanan.
                        </p>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-orange-200 bg-orange-50 p-5">
                <p class="text-sm font-bold text-orange-900">Perlu perubahan data?</p>
                <p class="mt-2 text-sm leading-6 text-orange-800">
                    Hubungi admin untuk memperbarui data SIM, kendaraan, status operasional, atau catatan driver.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection