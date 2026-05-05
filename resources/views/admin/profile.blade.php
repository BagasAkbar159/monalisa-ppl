@extends('layouts.app')

@section('content')
@php
    $user = auth()->user();
    $roleName = $user?->getRoleNames()->first() ?? 'admin';
@endphp

<div class="space-y-6">
    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <h1 class="app-page-title">Profil Admin</h1>
            <p class="app-page-subtitle">
                Lihat informasi akun, role, dan akses operasional admin MONALISA.
            </p>
        </div>

        <div class="flex flex-wrap gap-2">
            <a href="{{ route('profile.edit') }}" class="app-btn-accent">
                Edit Akun
            </a>

            <a href="{{ route('admin.dashboard') }}" class="app-btn-secondary">
                Dashboard
            </a>
        </div>
    </div>

    <div class="grid gap-4 md:grid-cols-3">
        <div class="app-card border-[#163A63]/20 bg-gradient-to-br from-white to-blue-50">
            <div class="app-card-body">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold text-slate-500">Role Akun</p>
                        <p class="mt-3 text-3xl font-extrabold text-[#163A63]">
                            {{ ucfirst($roleName) }}
                        </p>
                        <p class="mt-1 text-xs text-slate-500">
                            Hak akses utama sistem
                        </p>
                    </div>

                    <div class="rounded-2xl bg-[#163A63] p-3 text-white">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M12 3l7.5 4.5v5.25C19.5 17.25 16.5 21 12 22c-4.5-1-7.5-4.75-7.5-9.25V7.5L12 3Z" />
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
                            @if ($user?->is_active)
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
                            Status login admin
                        </p>
                    </div>

                    <div class="rounded-2xl bg-emerald-50 p-3 text-emerald-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75 10 18.25 19.5 6.75" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-card">
            <div class="app-card-body">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold text-slate-500">Akses Modul</p>
                        <p class="mt-3 text-3xl font-extrabold text-slate-900">
                            Full
                        </p>
                        <p class="mt-1 text-xs text-slate-500">
                            Akses operasional admin
                        </p>
                    </div>

                    <div class="rounded-2xl bg-orange-50 p-3 text-orange-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h16M4 17h16" />
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
                        Data akun admin yang digunakan untuk login dan mengelola sistem.
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
                            {{ ucfirst($roleName) }}
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-500">
                            Dibuat Pada
                        </p>
                        <p class="mt-2 text-sm font-bold text-slate-900">
                            {{ $user?->created_at ? $user->created_at->format('d M Y, H:i') : '-' }}
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-500">
                            Update Terakhir
                        </p>
                        <p class="mt-2 text-sm font-bold text-slate-900">
                            {{ $user?->updated_at ? $user->updated_at->format('d M Y, H:i') : '-' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="app-card">
                <div class="app-card-body">
                    <h2 class="text-lg font-bold text-slate-900">Aksi Akun</h2>
                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Admin dapat memperbarui nama, email, dan password melalui halaman edit akun bawaan sistem.
                    </p>

                    <a href="{{ route('profile.edit') }}" class="app-btn-primary mt-5 w-full">
                        Edit Akun Login
                    </a>
                </div>
            </div>

            <div class="rounded-2xl border border-orange-200 bg-orange-50 p-5">
                <p class="text-sm font-bold text-orange-900">Catatan Keamanan</p>
                <p class="mt-2 text-sm leading-6 text-orange-800">
                    Akun admin memiliki akses ke data operasional penting. Jangan gunakan password murahan seperti
                    <span class="font-bold">12345678</span>, kecuali kamu memang ingin database menangis.
                </p>
            </div>
        </div>
    </div>

    <div class="app-card overflow-hidden">
        <div class="border-b border-slate-200 px-6 py-5">
            <h2 class="text-lg font-bold text-slate-900">Akses Operasional Admin</h2>
            <p class="mt-1 text-sm text-slate-500">
                Modul utama yang dapat dikelola oleh admin.
            </p>
        </div>

        <div class="grid gap-0 divide-y divide-slate-200 md:grid-cols-2 md:divide-x md:divide-y-0">
            <div class="p-6">
                <div class="flex items-start gap-4">
                    <div class="rounded-2xl bg-blue-50 p-3 text-blue-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7 12 3 4 7m16 0-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>

                    <div>
                        <p class="font-bold text-slate-900">Stock & Produksi</p>
                        <p class="mt-1 text-sm leading-6 text-slate-500">
                            Mengelola produksi ayam dan memantau pergerakan stock masuk/keluar.
                        </p>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <div class="flex items-start gap-4">
                    <div class="rounded-2xl bg-orange-50 p-3 text-orange-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6M7 4h10l2 3v13H5V7l2-3Z" />
                        </svg>
                    </div>

                    <div>
                        <p class="font-bold text-slate-900">Pesanan</p>
                        <p class="mt-1 text-sm leading-6 text-slate-500">
                            Memproses pesanan customer, mengubah status, dan membatalkan pesanan bila diperlukan.
                        </p>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <div class="flex items-start gap-4">
                    <div class="rounded-2xl bg-emerald-50 p-3 text-emerald-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 0 0-5-3.87M9 20H4v-2a4 4 0 0 1 5-3.87m0 0a4 4 0 1 0 0-7.75m8 7.75a4 4 0 1 0 0-7.75" />
                        </svg>
                    </div>

                    <div>
                        <p class="font-bold text-slate-900">Customer & Driver</p>
                        <p class="mt-1 text-sm leading-6 text-slate-500">
                            Mengelola data customer, status verifikasi, data driver, dan status operasional.
                        </p>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <div class="flex items-start gap-4">
                    <div class="rounded-2xl bg-yellow-50 p-3 text-yellow-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.5 0-2.5.8-2.5 2s1 2 2.5 2 2.5.8 2.5 2-1 2-2.5 2m0-8V6m0 12v-2m9-4a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>

                    <div>
                        <p class="font-bold text-slate-900">Katalog Harga</p>
                        <p class="mt-1 text-sm leading-6 text-slate-500">
                            Mengatur harga aktif ayam per kilogram untuk perhitungan estimasi pesanan.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection