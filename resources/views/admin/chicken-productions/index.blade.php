@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <h1 class="app-page-title">Produksi Ayam</h1>
            <p class="app-page-subtitle">
                Kelola data produksi atau panen ayam yang menjadi sumber stock masuk MONALISA.
            </p>
        </div>

        <div class="flex flex-wrap gap-2">
            <a href="{{ route('admin.chicken-productions.create') }}" class="app-btn-accent">
                Tambah Produksi
            </a>

            <a href="{{ route('admin.stock.index') }}" class="app-btn-secondary">
                Lihat Stock
            </a>
        </div>
    </div>

    <div class="mt-6 grid gap-4 sm:grid-cols-2">
        <div class="app-card">
            <div class="app-card-body">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold text-slate-500">Total Produksi</p>
                        <p class="mt-3 text-3xl font-extrabold text-slate-900">
                            {{ number_format($totalChicken ?? 0, 0, ',', '.') }}
                        </p>
                        <p class="mt-1 text-xs text-slate-500">
                            Ekor ayam tercatat
                        </p>
                    </div>

                    <div class="rounded-2xl bg-orange-50 p-3 text-orange-600">
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
                        <p class="text-sm font-semibold text-slate-500">Total Berat</p>
                        <p class="mt-3 text-3xl font-extrabold text-slate-900">
                            {{ number_format($totalWeight ?? 0, 2, ',', '.') }}
                        </p>
                        <p class="mt-1 text-xs text-slate-500">
                            Kilogram estimasi produksi
                        </p>
                    </div>

                    <div class="rounded-2xl bg-blue-50 p-3 text-blue-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 7h12l1.5 13h-15L6 7Zm3 0a3 3 0 0 1 6 0" />
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
                    <h2 class="text-lg font-bold text-slate-900">Riwayat Produksi</h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Data produksi terbaru ditampilkan berdasarkan tanggal produksi.
                    </p>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full table-fixed divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="w-[18%] px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                            Tanggal
                        </th>
                        <th class="w-[18%] px-6 py-3 text-right text-xs font-bold uppercase tracking-wider text-slate-500">
                            Jumlah Ayam
                        </th>
                        <th class="w-[18%] px-6 py-3 text-right text-xs font-bold uppercase tracking-wider text-slate-500">
                            Total Berat
                        </th>
                        <th class="w-[28%] px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                            Catatan
                        </th>
                        <th class="w-[18%] px-6 py-3 text-right text-xs font-bold uppercase tracking-wider text-slate-500">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse ($productions as $production)
                        <tr class="transition hover:bg-slate-50">
                            <td class="w-[18%] whitespace-nowrap px-6 py-4 text-sm text-slate-700">
                                {{ $production->production_date ? $production->production_date->format('d M Y') : '-' }}
                            </td>

                            <td class="w-[18%] whitespace-nowrap px-6 py-4 text-right text-sm font-bold text-emerald-700">
                                +{{ number_format($production->quantity_chicken ?? 0, 0, ',', '.') }} ekor
                            </td>

                            <td class="w-[18%] whitespace-nowrap px-6 py-4 text-right text-sm font-bold text-slate-900">
                                {{ number_format($production->total_weight_kg ?? 0, 2, ',', '.') }} kg
                            </td>

                            <td class="w-[28%] px-6 py-4 text-sm text-slate-600">
                                <span class="block truncate" title="{{ $production->notes ?: '-' }}">
                                    {{ $production->notes ?: '-' }}
                                </span>
                            </td>

                            <td class="w-[18%] whitespace-nowrap px-6 py-4 text-right">
                                <div class="flex justify-end gap-3">
                                    <a href="{{ route('admin.chicken-productions.show', $production) }}"
                                       class="app-badge app-badge-blue">
                                        Detail
                                    </a>

                                    <a href="{{ route('admin.chicken-productions.edit', $production) }}"
                                       class="app-badge app-badge-orange">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.chicken-productions.destroy', $production) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus data produksi ini? Stock akan ikut berubah karena produksi ini adalah sumber stock masuk.');">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="app-badge app-badge-red">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-14 text-center">
                                <div class="mx-auto flex max-w-md flex-col items-center">
                                    <div class="rounded-2xl bg-slate-100 p-4 text-slate-500">
                                        <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7 12 3 4 7m16 0-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                        </svg>
                                    </div>

                                    <h3 class="mt-4 text-base font-bold text-slate-900">
                                        Belum ada data produksi
                                    </h3>

                                    <p class="mt-1 text-sm text-slate-500">
                                        Tambahkan produksi ayam pertama untuk mulai mencatat stock masuk.
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

        @if ($productions->hasPages())
            <div class="border-t border-slate-200 px-6 py-4">
                {{ $productions->links() }}
            </div>
        @endif
    </div>
</div>
@endsection