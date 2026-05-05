@extends('layouts.app')

@section('content')
@php
    $user = auth()->user();
    $roleName = $user?->getRoleNames()->first() ?? 'direktur';
@endphp

<div class="space-y-6">
    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <h1 class="app-page-title">Profil Direktur</h1>
            <p class="app-page-subtitle">
                Lihat informasi akun, role, dan akses monitoring direktur MONALISA.
            </p>
        </div>

        <div class="flex flex-wrap gap-2">
            <a href="{{ route('profile.edit') }}" class="app-btn-accent">
                Edit Akun
            </a>

            <a href="{{ route('direktur.dashboard') }}" class="app-btn-secondary">
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
                            Hak akses monitoring sistem
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
                            Status login direktur
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
                        <p class="text-sm font-semibold text-slate-500">Mode Akses</p>
                        <p class="mt-3 text-3xl font-extrabold text-slate-900">
                            Read
                        </p>
                        <p class="mt-1 text-xs text-slate-500">
                            Monitoring dan laporan
                        </p>
                    </div>

                    <div class="rounded-2xl bg-orange-50 p-3 text-orange-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 19V5m5 14V9m5 10V7m5 12V3" />
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
                        Data akun direktur yang digunakan untuk login ke sistem MONALISA.
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
                        Direktur dapat memperbarui informasi akun dasar seperti nama, email, dan password.
                    </p>

                    <a href="{{ route('profile.edit') }}" class="app-btn-primary mt-5 w-full">
                        Edit Akun Login
                    </a>
                </div>
            </div>

            <div class="rounded-2xl border border-orange-200 bg-orange-50 p-5">
                <p class="text-sm font-bold text-orange-900">Catatan Keamanan</p>
                <p class="mt-2 text-sm leading-6 text-orange-800">
                    Akun direktur dipakai untuk membaca ringkasan operasional dan laporan. Jangan pakai password receh,
                    karena data perusahaan bukan tempat eksperimen keberuntungan.
                </p>
            </div>
        </div>
    </div>

    <div class="app-card overflow-hidden">
        <div class="border-b border-slate-200 px-6 py-5">
            <h2 class="text-lg font-bold text-slate-900">Akses Monitoring Direktur</h2>
            <p class="mt-1 text-sm text-slate-500">
                Area utama yang dapat dipantau oleh direktur.
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
                        <p class="font-bold text-slate-900">Monitoring Stock</p>
                        <p class="mt-1 text-sm leading-6 text-slate-500">
                            Melihat ringkasan produksi, stock masuk, stock keluar, dan stock tersedia.
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
                        <p class="font-bold text-slate-900">Monitoring Pesanan</p>
                        <p class="mt-1 text-sm leading-6 text-slate-500">
                            Melihat perkembangan pesanan customer berdasarkan status operasional.
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
                            Memantau data customer, status verifikasi, driver, dan kesiapan operasional.
                        </p>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <div class="flex items-start gap-4">
                    <div class="rounded-2xl bg-yellow-50 p-3 text-yellow-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 19V5m5 14V9m5 10V7m5 12V3" />
                        </svg>
                    </div>

                    <div>
                        <p class="font-bold text-slate-900">Laporan Manajemen</p>
                        <p class="mt-1 text-sm leading-6 text-slate-500">
                            Area laporan penjualan, pengiriman, QC, dan keuangan untuk pengembangan berikutnya.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-3">
        <div class="app-card lg:col-span-2">
            <div class="app-card-body">
                <h2 class="text-lg font-bold text-slate-900">Batasan Akses Direktur</h2>
                <p class="mt-2 text-sm leading-6 text-slate-500">
                    Role direktur difokuskan untuk melihat ringkasan dan laporan, bukan melakukan operasi harian seperti
                    tambah produksi, edit harga, batalkan pesanan, atau nonaktifkan user.
                </p>

                <div class="mt-6 grid gap-4 sm:grid-cols-2">
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                        <p class="font-bold text-slate-900">Tidak mengubah data operasional</p>
                        <p class="mt-2 text-sm leading-6 text-slate-500">
                            Operasi CRUD tetap menjadi tanggung jawab admin.
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                        <p class="font-bold text-slate-900">Fokus pada monitoring</p>
                        <p class="mt-2 text-sm leading-6 text-slate-500">
                            Direktur melihat data untuk evaluasi, bukan mengutak-atik transaksi.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-card border-[#163A63]/20 bg-gradient-to-br from-white to-blue-50">
            <div class="app-card-body">
                <h2 class="text-lg font-bold text-slate-900">Direktur Mode</h2>
                <p class="mt-2 text-sm leading-6 text-slate-500">
                    Mode ini disiapkan untuk laporan dan pengambilan keputusan.
                </p>

                <div class="mt-5 rounded-2xl bg-[#102C4D] p-5 text-white">
                    <p class="text-sm font-semibold text-orange-200">Access Type</p>
                    <p class="mt-2 text-2xl font-extrabold">Read-Only</p>
                    <p class="mt-3 text-sm leading-6 text-slate-200">
                        Bukan tombol hapus. Bukan tombol edit stock. Bukan panggung untuk membuat database trauma.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection