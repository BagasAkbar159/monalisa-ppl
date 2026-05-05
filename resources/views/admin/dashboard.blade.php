@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <h1 class="app-page-title">Dashboard Admin</h1>
            <p class="app-page-subtitle">
                Pantau ringkasan stock, customer, driver, dan aktivitas operasional MONALISA.
            </p>
        </div>

        <div class="flex flex-wrap gap-2">
            <a href="{{ route('admin.chicken-productions.create') }}" class="app-btn-accent">
                Tambah Produksi
            </a>
            {{-- <a href="{{ route('admin.orders.create') }}" class="app-btn-primary">
                Buat Pesanan
            </a> --}}
        </div>
    </div>

    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <div class="app-card">
            <div class="app-card-body">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Total Ayam</p>
                        <p class="mt-3 text-3xl font-extrabold text-slate-900">
                            {{ number_format($totalChicken ?? 0, 0, ',', '.') }}
                        </p>
                        <p class="mt-1 text-xs text-slate-500">Ekor dari total produksi</p>
                    </div>

                    <div class="rounded-2xl bg-orange-50 p-3 text-orange-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.5 0 4.5 2 4.5 4.5S14.5 12 12 12 7.5 10 7.5 7.5 9.5 3 12 3Zm0 9c4 0 7 2.5 7 5.5V20H5v-2.5C5 14.5 8 12 12 12Z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-card">
            <div class="app-card-body">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Total Berat Stock</p>
                        <p class="mt-3 text-3xl font-extrabold text-slate-900">
                            {{ number_format($totalWeight ?? 0, 2, ',', '.') }}
                        </p>
                        <p class="mt-1 text-xs text-slate-500">Kilogram estimasi</p>
                    </div>

                    <div class="rounded-2xl bg-blue-50 p-3 text-blue-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 7h12l1.5 13h-15L6 7Zm3 0a3 3 0 0 1 6 0" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-card">
            <div class="app-card-body">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Total Customer</p>
                        <p class="mt-3 text-3xl font-extrabold text-slate-900">
                            {{ number_format($totalCustomers ?? 0, 0, ',', '.') }}
                        </p>
                        <p class="mt-1 text-xs text-slate-500">Customer terdaftar</p>
                    </div>

                    <div class="rounded-2xl bg-emerald-50 p-3 text-emerald-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 0 0-5-3.87M9 20H4v-2a4 4 0 0 1 5-3.87m0 0a4 4 0 1 0 0-7.75m8 7.75a4 4 0 1 0 0-7.75" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-card">
            <div class="app-card-body">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Total Driver</p>
                        <p class="mt-3 text-3xl font-extrabold text-slate-900">
                            {{ number_format($totalDrivers ?? 0, 0, ',', '.') }}
                        </p>
                        <p class="mt-1 text-xs text-slate-500">Driver operasional</p>
                    </div>

                    <div class="rounded-2xl bg-sky-50 p-3 text-sky-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 13h18l-2-5H5l-2 5Zm2 0v5m14-5v5M7 18h.01M17 18h.01" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid gap-6 xl:grid-cols-3">
        <div class="app-card xl:col-span-2">
            <div class="app-card-body">
                <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-start">
                    <div>
                        <h2 class="text-lg font-bold text-slate-900">Aksi Cepat</h2>
                        <p class="mt-1 text-sm text-slate-500">
                            Akses fitur operasional utama tanpa muter-muter seperti mencari tombol submit di form warisan.
                        </p>
                    </div>
                </div>

                <div class="mt-6 grid gap-4 sm:grid-cols-2">
                    <a href="{{ route('admin.chicken-productions.create') }}"
                       class="group rounded-2xl border border-slate-200 bg-slate-50 p-5 transition hover:border-orange-200 hover:bg-orange-50">
                        <div class="flex items-center gap-4">
                            <div class="rounded-2xl bg-orange-100 p-3 text-orange-700 transition group-hover:bg-orange-500 group-hover:text-white">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-bold text-slate-900">Tambah Produksi</p>
                                <p class="mt-1 text-sm text-slate-500">Input stock ayam hasil produksi/panen.</p>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('admin.stock.index') }}"
                       class="group rounded-2xl border border-slate-200 bg-slate-50 p-5 transition hover:border-blue-200 hover:bg-blue-50">
                        <div class="flex items-center gap-4">
                            <div class="rounded-2xl bg-blue-100 p-3 text-blue-700 transition group-hover:bg-blue-500 group-hover:text-white">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7 12 3 4 7m16 0-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-bold text-slate-900">Lihat Stock</p>
                                <p class="mt-1 text-sm text-slate-500">Pantau stock masuk, keluar, dan tersedia.</p>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('admin.orders.index') }}"
                       class="group rounded-2xl border border-slate-200 bg-slate-50 p-5 transition hover:border-emerald-200 hover:bg-emerald-50">
                        <div class="flex items-center gap-4">
                            <div class="rounded-2xl bg-emerald-100 p-3 text-emerald-700 transition group-hover:bg-emerald-500 group-hover:text-white">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6M7 4h10l2 3v13H5V7l2-3Z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-bold text-slate-900">Kelola Pesanan</p>
                                <p class="mt-1 text-sm text-slate-500">Lihat dan proses pesanan customer.</p>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('admin.chicken-price-catalogs.index') }}"
                       class="group rounded-2xl border border-slate-200 bg-slate-50 p-5 transition hover:border-yellow-200 hover:bg-yellow-50">
                        <div class="flex items-center gap-4">
                            <div class="rounded-2xl bg-yellow-100 p-3 text-yellow-700 transition group-hover:bg-yellow-500 group-hover:text-white">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.5 0-2.5.8-2.5 2s1 2 2.5 2 2.5.8 2.5 2-1 2-2.5 2m0-8V6m0 12v-2m9-4a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-bold text-slate-900">Kelola Harga</p>
                                <p class="mt-1 text-sm text-slate-500">Atur harga aktif ayam per kilogram.</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="app-card">
            <div class="app-card-body">
                <h2 class="text-lg font-bold text-slate-900">Catatan Sistem</h2>
                <p class="mt-2 text-sm leading-6 text-slate-500">
                    Stock tersedia dihitung otomatis dari total produksi ayam dikurangi pesanan dengan status
                    <span class="font-semibold text-slate-700">diproses</span>,
                    <span class="font-semibold text-slate-700">dikirim</span>, dan
                    <span class="font-semibold text-slate-700">selesai</span>.
                </p>

                <div class="mt-5 rounded-2xl bg-[#102C4D] p-5 text-white">
                    <p class="text-sm font-semibold text-orange-200">MONALISA Workflow</p>
                    <p class="mt-2 text-2xl font-extrabold">
                        Produksi → Stock → Pesanan → Pengiriman
                    </p>
                    <p class="mt-3 text-sm leading-6 text-slate-200">
                        Modul pengiriman, invoice, pembayaran, QC, dan audit log bisa ditambahkan setelah alur utama stabil.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection