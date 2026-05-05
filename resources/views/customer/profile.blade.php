@extends('layouts.app')

@section('content')
@php
    $user = auth()->user();
    $customer = $user->customer;
@endphp

<div class="space-y-6">
    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <h1 class="app-page-title">Profil Customer</h1>
            <p class="app-page-subtitle">
                Lihat informasi akun, perusahaan, alamat, dan status verifikasi customer.
            </p>
        </div>

        <div class="flex flex-wrap gap-2">
            <a href="{{ route('profile.edit') }}" class="app-btn-secondary">
                Edit Akun
            </a>

            <a href="{{ route('customer.dashboard') }}" class="app-btn-secondary">
                Dashboard
            </a>
        </div>
    </div>

    @if (! $customer)
        <div class="rounded-2xl border border-orange-200 bg-orange-50 p-5 text-orange-900">
            <p class="text-sm font-bold">Data customer belum tersedia</p>
            <p class="mt-2 text-sm leading-6">
                Akun ini memiliki role customer, tetapi belum memiliki data customer yang terhubung.
                Hubungi admin untuk melengkapi data customer. Role tanpa profil, sebuah karya abstrak dari database.
            </p>
        </div>
    @endif

    <div class="grid gap-4 md:grid-cols-3">
        <div class="app-card">
            <div class="app-card-body">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold text-slate-500">Status Verifikasi</p>

                        <div class="mt-4">
                            @if ($customer?->is_verified)
                                <span class="app-badge app-badge-blue">
                                    Terverifikasi
                                </span>
                            @else
                                <span class="app-badge app-badge-slate">
                                    Menunggu Verifikasi
                                </span>
                            @endif
                        </div>

                        <p class="mt-3 text-xs text-slate-500">
                            Status validasi data customer
                        </p>
                    </div>

                    <div class="rounded-2xl bg-blue-50 p-3 text-blue-600">
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
                        <p class="text-sm font-semibold text-slate-500">Status Customer</p>

                        <div class="mt-4">
                            @if ($customer?->is_active)
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
                            Status akun customer
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

        <div class="app-card border-[#163A63]/20 bg-gradient-to-br from-white to-blue-50">
            <div class="app-card-body">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold text-slate-500">Perusahaan</p>
                        <p class="mt-3 truncate text-2xl font-extrabold text-[#163A63]">
                            {{ $customer->company_name ?? '-' }}
                        </p>
                        <p class="mt-1 text-xs text-slate-500">
                            Nama perusahaan/customer
                        </p>
                    </div>

                    <div class="rounded-2xl bg-[#163A63] p-3 text-white">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 21h18M5 21V7l8-4v18M19 21V11l-6-4M9 9h.01M9 13h.01M9 17h.01M13 9h.01M13 13h.01M13 17h.01" />
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
                        Data akun login customer yang digunakan untuk masuk ke sistem MONALISA.
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
                            Customer
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-card">
            <div class="app-card-body">
                <h2 class="text-lg font-bold text-slate-900">Akses Akun</h2>
                <p class="mt-2 text-sm leading-6 text-slate-500">
                    Customer dapat memperbarui informasi akun dasar melalui halaman profil akun.
                    Data perusahaan dan verifikasi dikelola sesuai kebijakan admin.
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
                    <h2 class="text-lg font-bold text-slate-900">Informasi Customer</h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Data perusahaan dan alamat customer untuk kebutuhan pemesanan serta distribusi.
                    </p>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5 sm:col-span-2">
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-500">
                            Nama Perusahaan
                        </p>
                        <p class="mt-2 text-sm font-bold text-slate-900">
                            {{ $customer->company_name ?? '-' }}
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-500">
                            Kota/Kabupaten
                        </p>
                        <p class="mt-2 text-sm font-bold text-slate-900">
                            {{ $customer->city->name ?? '-' }}
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-500">
                            Kecamatan
                        </p>
                        <p class="mt-2 text-sm font-bold text-slate-900">
                            {{ $customer->district->name ?? '-' }}
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-500">
                            Desa/Kelurahan
                        </p>
                        <p class="mt-2 text-sm font-bold text-slate-900">
                            {{ $customer->village_name ?? '-' }}
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-500">
                            Tanggal Verifikasi
                        </p>
                        <p class="mt-2 text-sm font-bold text-slate-900">
                            {{ $customer?->verified_at ? $customer->verified_at->format('d M Y, H:i') : '-' }}
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5 sm:col-span-2">
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-500">
                            Detail Alamat
                        </p>
                        <p class="mt-2 whitespace-pre-line text-sm leading-6 text-slate-700">
                            {{ $customer->detail_address ?? '-' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="app-card border-[#163A63]/20 bg-gradient-to-br from-white to-blue-50">
                <div class="app-card-body">
                    <h2 class="text-lg font-bold text-slate-900">Pesanan Customer</h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Kelola pesanan ayam melalui menu pesanan customer.
                    </p>

                    <div class="mt-6 rounded-2xl bg-[#102C4D] p-5 text-white">
                        <p class="text-sm font-semibold text-orange-200">Order Flow</p>
                        <p class="mt-2 text-2xl font-extrabold">
                            Buat → Pantau → Selesai
                        </p>
                        <p class="mt-3 text-sm leading-6 text-slate-200">
                            Pesanan akan diproses oleh admin dan statusnya dapat dipantau melalui daftar pesanan.
                        </p>
                    </div>

                    <div class="mt-5 grid gap-3">
                        <a href="{{ route('customer.orders.create') }}" class="app-btn-accent w-full">
                            Buat Pesanan
                        </a>

                        <a href="{{ route('customer.orders.index') }}" class="app-btn-secondary w-full">
                            Pesanan Saya
                        </a>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-orange-200 bg-orange-50 p-5">
                <p class="text-sm font-bold text-orange-900">Perlu perubahan data?</p>
                <p class="mt-2 text-sm leading-6 text-orange-800">
                    Jika data perusahaan atau alamat belum sesuai, hubungi admin untuk pembaruan data.
                    Karena alamat salah bukan bug kecil kalau ayamnya dikirim ke kecamatan antah-berantah.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection