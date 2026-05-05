@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <h1 class="app-page-title">Dashboard Direktur</h1>
            <p class="app-page-subtitle">
                Pantau ringkasan operasional MONALISA secara read-only.
            </p>
        </div>

        <span class="app-badge app-badge-blue">
            Direktur
        </span>
    </div>

    <div class="grid gap-4 md:grid-cols-4">
        <div class="app-card">
            <div class="app-card-body">
                <p class="text-sm font-semibold text-slate-500">Status Akses</p>
                <p class="mt-3 text-3xl font-extrabold text-[#163A63]">Read</p>
                <p class="mt-1 text-xs text-slate-500">Monitoring operasional</p>
            </div>
        </div>

        <div class="app-card">
            <div class="app-card-body">
                <p class="text-sm font-semibold text-slate-500">Laporan</p>
                <p class="mt-3 text-3xl font-extrabold text-slate-900">Soon</p>
                <p class="mt-1 text-xs text-slate-500">Penjualan, stock, pengiriman</p>
            </div>
        </div>

        <div class="app-card">
            <div class="app-card-body">
                <p class="text-sm font-semibold text-slate-500">QC</p>
                <p class="mt-3 text-3xl font-extrabold text-slate-900">Soon</p>
                <p class="mt-1 text-xs text-slate-500">Kontrol kualitas</p>
            </div>
        </div>

        <div class="app-card">
            <div class="app-card-body">
                <p class="text-sm font-semibold text-slate-500">Keuangan</p>
                <p class="mt-3 text-3xl font-extrabold text-slate-900">Soon</p>
                <p class="mt-1 text-xs text-slate-500">Invoice dan pembayaran</p>
            </div>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-3">
        <div class="app-card lg:col-span-2">
            <div class="app-card-body">
                <h2 class="text-lg font-bold text-slate-900">Akses Direktur</h2>
                <p class="mt-2 text-sm leading-6 text-slate-500">
                    Akun direktur disiapkan untuk monitoring, laporan, dan pengambilan keputusan.
                    Pada tahap ini, direktur tidak mengubah data operasional langsung.
                </p>

                <div class="mt-6 grid gap-4 sm:grid-cols-2">
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                        <p class="font-bold text-slate-900">Dashboard Penjualan</p>
                        <p class="mt-2 text-sm leading-6 text-slate-500">
                            Ringkasan penjualan dan pesanan akan ditampilkan setelah modul laporan selesai.
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                        <p class="font-bold text-slate-900">Dashboard Stock</p>
                        <p class="mt-2 text-sm leading-6 text-slate-500">
                            Monitoring stock dan produksi dapat dikembangkan sebagai laporan read-only.
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                        <p class="font-bold text-slate-900">Dashboard Pengiriman</p>
                        <p class="mt-2 text-sm leading-6 text-slate-500">
                            Modul pengiriman belum aktif penuh, jadi dashboard ini disiapkan untuk tahap berikutnya.
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                        <p class="font-bold text-slate-900">Dashboard QC</p>
                        <p class="mt-2 text-sm leading-6 text-slate-500">
                            QC driver dan customer akan masuk ke ringkasan direktur setelah modul QC tersedia.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="app-card border-[#163A63]/20 bg-gradient-to-br from-white to-blue-50">
                <div class="app-card-body">
                    <h2 class="text-lg font-bold text-slate-900">Catatan Implementasi</h2>
                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Berdasarkan rancangan sistem, direktur berfokus pada dashboard dan laporan seperti penjualan,
                        pengiriman, QC, dan keuangan bulanan.
                    </p>

                    <div class="mt-5 rounded-2xl bg-[#102C4D] p-5 text-white">
                        <p class="text-sm font-semibold text-orange-200">Direktur Mode</p>
                        <p class="mt-2 text-2xl font-extrabold">Monitoring</p>
                        <p class="mt-3 text-sm leading-6 text-slate-200">
                            Bukan CRUD. Bukan tombol hapus. Bukan tempat eksperimen nasib database.
                        </p>
                    </div>
                </div>
            </div>

            <a href="{{ route('direktur.profile') }}" class="app-btn-secondary w-full">
                Edit Akun Login
            </a>
        </div>
    </div>
</div>
@endsection