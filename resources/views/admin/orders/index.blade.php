@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <h1 class="app-page-title">Pesanan</h1>
            <p class="app-page-subtitle">
                Kelola pesanan customer dan pantau status transaksi operasional MONALISA.
            </p>
        </div>

        {{-- <a href="{{ route('admin.orders.create') }}" class="app-btn-accent">
            Buat Pesanan
        </a> --}}
    </div>

    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <div class="app-card">
            <div class="app-card-body">
                <p class="text-sm font-semibold text-slate-500">Data Ditampilkan</p>
                <p class="mt-3 text-3xl font-extrabold text-slate-900">
                    {{ $orders->count() }}
                </p>
                <p class="mt-1 text-xs text-slate-500">
                    Pesanan pada halaman ini
                </p>
            </div>
        </div>

        <div class="app-card sm:col-span-1 lg:col-span-3">
            <div class="app-card-body">
                <p class="text-sm font-semibold text-slate-500">Catatan Status</p>
                <div class="mt-3 flex flex-wrap gap-2">
                    <span class="app-badge app-badge-slate">Masuk</span>
                    <span class="app-badge app-badge-orange">Diproses</span>
                    <span class="app-badge app-badge-blue">Dikirim</span>
                    <span class="app-badge app-badge-green">Selesai</span>
                    <span class="app-badge app-badge-red">Dibatalkan</span>
                </div>
                <p class="mt-3 text-xs text-slate-500">
                    Status diproses, dikirim, dan selesai dihitung sebagai stock keluar. Status dibatalkan tidak mengurangi stock.
                </p>
            </div>
        </div>
    </div>

    <div class="app-card overflow-hidden">
        <div class="border-b border-slate-200 px-6 py-5">
            <div class="flex flex-col justify-between gap-3 sm:flex-row sm:items-center">
                <div>
                    <h2 class="text-lg font-bold text-slate-900">Daftar Pesanan</h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Pesanan terbaru ditampilkan berdasarkan tanggal order.
                    </p>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full table-fixed divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="w-[16%] px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500">Kode</th>
                        <th class="w-[21%] px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500">Customer</th>
                        <th class="w-[13%] px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500">Tanggal</th>
                        <th class="w-[13%] px-6 py-3 text-right text-xs font-bold uppercase tracking-wider text-slate-500">Jumlah</th>
                        <th class="w-[15%] px-6 py-3 text-right text-xs font-bold uppercase tracking-wider text-slate-500">Total</th>
                        <th class="w-[12%] px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500">Status</th>
                        <th class="w-[10%] px-6 py-3 text-right text-xs font-bold uppercase tracking-wider text-slate-500">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse ($orders as $order)
                        @php
                            $statusClass = match ($order->status) {
                                'masuk' => 'app-badge-slate',
                                'diproses' => 'app-badge-orange',
                                'dikirim' => 'app-badge-blue',
                                'selesai' => 'app-badge-green',
                                'dibatalkan' => 'app-badge-red',
                                default => 'app-badge-slate',
                            };
                        @endphp

                        <tr class="transition hover:bg-slate-50">
                            <td class="w-[16%] whitespace-nowrap px-6 py-4">
                                <div>
                                    <p class="text-sm font-bold text-slate-900">{{ $order->order_code }}</p>
                                    <p class="mt-1 text-xs text-slate-500">ID #{{ $order->id }}</p>
                                </div>
                            </td>

                            <td class="w-[21%] px-6 py-4">
                                <div class="min-w-0">
                                    <p class="truncate text-sm font-semibold text-slate-900">{{ $order->customer->company_name ?? '-' }}</p>
                                    <p class="truncate text-xs text-slate-500">{{ $order->customer->user->name ?? '-' }}</p>
                                </div>
                            </td>

                            <td class="w-[13%] whitespace-nowrap px-6 py-4 text-sm text-slate-700">
                                {{ $order->order_date ? $order->order_date->format('d M Y') : '-' }}
                            </td>

                            <td class="w-[13%] whitespace-nowrap px-6 py-4 text-right text-sm font-bold text-slate-900">
                                {{ number_format($order->quantity_chicken ?? 0, 0, ',', '.') }} ekor
                            </td>

                            <td class="w-[15%] whitespace-nowrap px-6 py-4 text-right text-sm font-bold text-slate-900">
                                Rp {{ number_format($order->estimated_total ?? 0, 0, ',', '.') }}
                            </td>

                            <td class="w-[12%] whitespace-nowrap px-6 py-4">
                                <span class="app-badge {{ $statusClass }}">{{ ucfirst($order->status) }}</span>
                            </td>

                            <td class="w-[10%] whitespace-nowrap px-6 py-4 text-right">
                                <div class="flex justify-end gap-3">
                                    <a href="{{ route('admin.orders.show', $order) }}" class="app-badge app-badge-blue">
                                        Detail
                                    </a>

                                    @if ($order->status !== 'dibatalkan')
                                        <a href="{{ route('admin.orders.edit', $order) }}" class="app-badge app-badge-orange">
                                            Edit
                                        </a>
                                    @endif

                                    @if (! in_array($order->status, ['selesai', 'dibatalkan'], true))
                                        <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan pesanan ini? Status akan berubah menjadi dibatalkan dan pesanan tetap tersimpan sebagai riwayat.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="app-badge app-badge-red">
                                                Batalkan
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
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6M7 4h10l2 3v13H5V7l2-3Z" />
                                        </svg>
                                    </div>

                                    <h3 class="mt-4 text-base font-bold text-slate-900">Belum ada pesanan</h3>
                                    <p class="mt-1 text-sm text-slate-500">Buat pesanan pertama untuk mulai mencatat transaksi customer.</p>
                                    <a href="{{ route('admin.orders.create') }}" class="app-btn-accent mt-5">Buat Pesanan</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($orders->hasPages())
            <div class="border-t border-slate-200 px-6 py-4">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
