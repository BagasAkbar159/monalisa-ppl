@extends('layouts.app')

@section('content')
@php
    $activePrice = $priceCatalogs->firstWhere('is_active', true);
@endphp

<div class="space-y-6">
    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <h1 class="app-page-title">Katalog Harga Ayam</h1>
            <p class="app-page-subtitle">
                Kelola harga ayam per kilogram yang digunakan untuk perhitungan estimasi pesanan.
            </p>
        </div>

        <div class="flex flex-wrap gap-2">
            <a href="{{ route('admin.chicken-price-catalogs.create') }}" class="app-btn-accent">
                Tambah Harga
            </a>

            <a href="{{ route('admin.orders.index') }}" class="app-btn-secondary">
                Lihat Pesanan
            </a>
        </div>
    </div>

    <div class="grid gap-4 lg:grid-cols-3">
        <div class="app-card border-[#163A63]/20 bg-gradient-to-br from-white to-blue-50 lg:col-span-2">
            <div class="app-card-body">
                <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-start">
                    <div>
                        <p class="text-sm font-semibold text-slate-500">Harga Aktif Saat Ini</p>

                        @if ($activePrice)
                            <p class="mt-3 text-4xl font-extrabold text-[#163A63]">
                                Rp {{ number_format($activePrice->price_per_kg ?? 0, 0, ',', '.') }}
                                <span class="text-base font-bold text-slate-500">/ kg</span>
                            </p>

                            <p class="mt-2 text-sm text-slate-500">
                                Berlaku sejak
                                <span class="font-semibold text-slate-700">
                                    {{ $activePrice->effective_date ? $activePrice->effective_date->format('d M Y') : '-' }}
                                </span>
                            </p>
                        @else
                            <p class="mt-3 text-2xl font-extrabold text-red-700">
                                Belum ada harga aktif
                            </p>

                            <p class="mt-2 text-sm text-slate-500">
                                Tambahkan harga aktif agar customer dapat membuat pesanan.
                            </p>
                        @endif
                    </div>

                    <div class="rounded-2xl bg-[#163A63] p-4 text-white">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.5 0-2.5.8-2.5 2s1 2 2.5 2 2.5.8 2.5 2-1 2-2.5 2m0-8V6m0 12v-2m9-4a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
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
                    <h2 class="text-lg font-bold text-slate-900">Riwayat Katalog Harga</h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Daftar harga ayam berdasarkan tanggal berlaku terbaru.
                    </p>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full table-fixed divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="w-[22%] px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                            Harga per Kg
                        </th>
                        <th class="w-[20%] px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                            Tanggal Berlaku
                        </th>
                        <th class="w-[16%] px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                            Status
                        </th>
                        <th class="w-[22%] px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                            Dibuat Oleh
                        </th>
                        <th class="w-[20%] px-6 py-3 text-right text-xs font-bold uppercase tracking-wider text-slate-500">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse ($priceCatalogs as $priceCatalog)
                        <tr class="transition hover:bg-slate-50">
                            <td class="w-[22%] whitespace-nowrap px-6 py-4">
                                <p class="text-sm font-extrabold text-slate-900">
                                    Rp {{ number_format($priceCatalog->price_per_kg ?? 0, 0, ',', '.') }}
                                </p>
                                <p class="mt-1 text-xs text-slate-500">
                                    per kilogram
                                </p>
                            </td>

                            <td class="w-[20%] whitespace-nowrap px-6 py-4 text-sm font-semibold text-slate-700">
                                {{ $priceCatalog->effective_date ? $priceCatalog->effective_date->format('d M Y') : '-' }}
                            </td>

                            <td class="w-[16%] whitespace-nowrap px-6 py-4">
                                @if ($priceCatalog->is_active)
                                    <span class="app-badge app-badge-green">
                                        Aktif
                                    </span>
                                @else
                                    <span class="app-badge app-badge-slate">
                                        Nonaktif
                                    </span>
                                @endif
                            </td>

                            <td class="w-[22%] px-6 py-4 text-sm text-slate-600">
                                <span class="block truncate">
                                    {{ $priceCatalog->creator->name ?? '-' }}
                                </span>
                            </td>

                            <td class="w-[20%] whitespace-nowrap px-6 py-4 text-right">
                                <div class="flex justify-end gap-3">
                                    <a href="{{ route('admin.chicken-price-catalogs.show', $priceCatalog) }}"
                                       class="app-badge app-badge-blue">
                                        Detail
                                    </a>

                                    <a href="{{ route('admin.chicken-price-catalogs.edit', $priceCatalog) }}"
                                       class="app-badge app-badge-orange">
                                        Edit
                                    </a>

                                    @if (! $priceCatalog->is_active)
                                        <form action="{{ route('admin.chicken-price-catalogs.destroy', $priceCatalog) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus data harga ini?');">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="app-badge app-badge-red">
                                                Hapus
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-14 text-center">
                                <div class="mx-auto flex max-w-md flex-col items-center">
                                    <div class="rounded-2xl bg-slate-100 p-4 text-slate-500">
                                        <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.5 0-2.5.8-2.5 2s1 2 2.5 2 2.5.8 2.5 2-1 2-2.5 2m0-8V6m0 12v-2m9-4a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                    </div>

                                    <h3 class="mt-4 text-base font-bold text-slate-900">
                                        Belum ada data harga
                                    </h3>

                                    <p class="mt-1 text-sm text-slate-500">
                                        Tambahkan harga ayam aktif agar order dapat menghitung estimasi total.
                                    </p>

                                    <a href="{{ route('admin.chicken-price-catalogs.create') }}" class="app-btn-accent mt-5">
                                        Tambah Harga
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($priceCatalogs->hasPages())
            <div class="border-t border-slate-200 px-6 py-4">
                {{ $priceCatalogs->links() }}
            </div>
        @endif
    </div>
</div>
@endsection