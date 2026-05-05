@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <h1 class="app-page-title">Stock Ayam</h1>
            <p class="app-page-subtitle">
                Pantau stock masuk dari produksi dan stock keluar dari pesanan customer.
            </p>
        </div>

        <div class="flex flex-wrap gap-2">
            <a href="{{ route('admin.chicken-price-catalogs.index') }}" class="app-btn-secondary">
                Kelola Harga
            </a>
        </div>
    </div>

    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <div class="app-card">
            <div class="app-card-body">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold text-slate-500">Stock Masuk</p>
                        <p class="mt-3 text-3xl font-extrabold text-slate-900">
                            {{ number_format($totalChickenProduction ?? 0, 0, ',', '.') }}
                        </p>
                        <p class="mt-1 text-xs text-slate-500">
                            {{ number_format($totalWeightProduction ?? 0, 2, ',', '.') }} kg dari produksi
                        </p>
                    </div>

                    <div class="rounded-2xl bg-emerald-50 p-3 text-emerald-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-card">
            <div class="app-card-body">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold text-slate-500">Stock Keluar</p>
                        <p class="mt-3 text-3xl font-extrabold text-slate-900">
                            {{ number_format($totalChickenOutgoing ?? 0, 0, ',', '.') }}
                        </p>
                        <p class="mt-1 text-xs text-slate-500">
                            {{ number_format($totalWeightOutgoing ?? 0, 2, ',', '.') }} kg dari transaksi
                        </p>
                    </div>

                    <div class="rounded-2xl bg-orange-50 p-3 text-orange-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-card border-[#163A63]/20 bg-gradient-to-br from-white to-blue-50">
            <div class="app-card-body">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold text-slate-500">Stock Tersedia</p>
                        <p class="mt-3 text-3xl font-extrabold text-[#163A63]">
                            {{ number_format($availableChicken ?? 0, 0, ',', '.') }}
                        </p>
                        <p class="mt-1 text-xs text-slate-500">
                            {{ number_format($availableWeight ?? 0, 2, ',', '.') }} kg tersedia
                        </p>
                    </div>

                    <div class="rounded-2xl bg-[#163A63] p-3 text-white">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7 12 3 4 7m16 0-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (($availableChicken ?? 0) <= 0)
        <div class="rounded-2xl border border-red-200 bg-red-50 p-4 text-sm text-red-800">
            <p class="font-bold">Peringatan stock kosong</p>
            <p class="mt-1">
                Stock tersedia saat ini habis atau minus. Tambahkan produksi sebelum memproses pesanan baru.
            </p>
        </div>
    @elseif (($availableChicken ?? 0) <= 10)
        <div class="rounded-2xl border border-orange-200 bg-orange-50 p-4 text-sm text-orange-800">
            <p class="font-bold">Stock mulai menipis</p>
            <p class="mt-1">
                Stock tersedia rendah. Sebaiknya tambahkan produksi agar transaksi tidak tertahan.
            </p>
        </div>
    @endif

    <div class="app-card">
        <div class="app-card-body">
            <div class="flex flex-col justify-between gap-4 lg:flex-row lg:items-center">
                <div>
                    <h2 class="text-lg font-bold text-slate-900">Riwayat Pergerakan Stock</h2>
                </div>

                <div class="flex flex-wrap gap-2">
                    @php
                        $activeFilterClass = 'rounded-xl bg-[#163A63] px-4 py-2 text-sm font-semibold text-white shadow-sm';
                        $inactiveFilterClass = 'rounded-xl border border-slate-300 bg-white px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50';
                    @endphp

                    <a href="{{ route('admin.stock.index', ['filter' => 'all']) }}"
                    class="{{ ($filter ?? 'all') === 'all' ? $activeFilterClass : $inactiveFilterClass }}">
                        Semua
                    </a>

                    <a href="{{ route('admin.stock.index', ['filter' => 'production']) }}"
                    class="{{ ($filter ?? 'all') === 'production' ? $activeFilterClass : $inactiveFilterClass }}">
                        Produksi
                    </a>

                    <a href="{{ route('admin.stock.index', ['filter' => 'transaction']) }}"
                    class="{{ ($filter ?? 'all') === 'transaction' ? $activeFilterClass : $inactiveFilterClass }}">
                        Transaksi
                    </a>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto border-t border-slate-200">
            <table class="min-w-full table-fixed divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="w-[16%] px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                            Tanggal
                        </th>
                        <th class="w-[16%] px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                            Sumber
                        </th>
                        <th class="w-[18%] px-6 py-3 text-right text-xs font-bold uppercase tracking-wider text-slate-500">
                            Jumlah Ayam
                        </th>
                        <th class="w-[18%] px-6 py-3 text-right text-xs font-bold uppercase tracking-wider text-slate-500">
                            Berat
                        </th>
                        <th class="w-[32%] px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                            Catatan
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse ($stockRows as $row)
                        @php
                            $isProduction = $row['source'] === 'Produksi';
                            $quantity = $row['quantity_chicken'] ?? 0;
                            $weight = $row['total_weight_kg'] ?? 0;
                        @endphp

                        <tr class="transition hover:bg-slate-50">
                            <td class="w-[16%] whitespace-nowrap px-6 py-4 text-sm text-slate-700">
                                {{ \Carbon\Carbon::parse($row['date'])->format('d M Y') }}
                            </td>

                            <td class="w-[16%] whitespace-nowrap px-6 py-4">
                                @if ($isProduction)
                                    <span class="app-badge app-badge-green">
                                        Produksi
                                    </span>
                                @else
                                    <span class="app-badge app-badge-orange">
                                        Transaksi
                                    </span>
                                @endif
                            </td>

                            <td class="w-[18%] whitespace-nowrap px-6 py-4 text-right text-sm font-bold {{ $isProduction ? 'text-emerald-700' : 'text-orange-700' }}">
                                {{ $quantity > 0 ? '+' : '' }}{{ number_format($quantity, 0, ',', '.') }} ekor
                            </td>

                            <td class="w-[18%] whitespace-nowrap px-6 py-4 text-right text-sm font-bold {{ $isProduction ? 'text-emerald-700' : 'text-orange-700' }}">
                                {{ $weight > 0 ? '+' : '' }}{{ number_format($weight, 2, ',', '.') }} kg
                            </td>

                            <td class="w-[32%] px-6 py-4 text-sm text-slate-600">
                                <span class="block truncate" title="{{ $row['notes'] ?: '-' }}">
                                    {{ $row['notes'] ?: '-' }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="mx-auto flex max-w-md flex-col items-center">
                                    <div class="rounded-2xl bg-slate-100 p-4 text-slate-500">
                                        <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7 12 3 4 7m16 0-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                        </svg>
                                    </div>

                                    <h3 class="mt-4 text-base font-bold text-slate-900">
                                        Belum ada data stock
                                    </h3>

                                    <p class="mt-1 text-sm text-slate-500">
                                        Tambahkan produksi ayam terlebih dahulu agar riwayat stock mulai tercatat.
                                    </p>

                                    <a href="{{ route('admin.chicken-productions.create') }}" class="app-btn-accent mt-5">
                                        Tambah Produksi
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection