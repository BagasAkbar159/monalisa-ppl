@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <h1 class="app-page-title">Pesanan Saya</h1>
            <p class="app-page-subtitle">Daftar pesanan ayam yang telah Anda buat.</p>
        </div>

        <a href="{{ route('customer.orders.create') }}" class="app-btn-accent">Buat Pesanan</a>
    </div>

    <div class="app-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full table-fixed divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="w-[18%] px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500">Kode</th>
                        <th class="w-[14%] px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500">Tanggal</th>
                        <th class="w-[14%] px-6 py-3 text-right text-xs font-bold uppercase tracking-wider text-slate-500">Jumlah</th>
                        <th class="w-[16%] px-6 py-3 text-right text-xs font-bold uppercase tracking-wider text-slate-500">Berat</th>
                        <th class="w-[18%] px-6 py-3 text-right text-xs font-bold uppercase tracking-wider text-slate-500">Total</th>
                        <th class="w-[12%] px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500">Status</th>
                        <th class="w-[8%] px-6 py-3 text-right text-xs font-bold uppercase tracking-wider text-slate-500">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse($orders as $order)
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
                            <td class="w-[18%] whitespace-nowrap px-6 py-4 text-sm font-bold text-slate-900">{{ $order->order_code }}</td>
                            <td class="w-[14%] whitespace-nowrap px-6 py-4 text-sm text-slate-700">{{ $order->order_date?->format('d M Y') ?? '-' }}</td>
                            <td class="w-[14%] whitespace-nowrap px-6 py-4 text-right text-sm font-bold text-slate-900">{{ number_format($order->quantity_chicken, 0, ',', '.') }} ekor</td>
                            <td class="w-[16%] whitespace-nowrap px-6 py-4 text-right text-sm text-slate-700">{{ number_format($order->estimated_weight_kg, 2, ',', '.') }} kg</td>
                            <td class="w-[18%] whitespace-nowrap px-6 py-4 text-right text-sm font-bold text-slate-900">Rp {{ number_format($order->estimated_total, 0, ',', '.') }}</td>
                            <td class="w-[12%] whitespace-nowrap px-6 py-4"><span class="app-badge {{ $statusClass }}">{{ ucfirst($order->status) }}</span></td>
                            <td class="w-[8%] whitespace-nowrap px-6 py-4 text-right">
                                <a href="{{ route('customer.orders.show', $order) }}" class="text-sm font-semibold text-[#163A63] hover:text-[#102C4D]">Detail</a>
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
                                    <p class="mt-1 text-sm text-slate-500">Buat pesanan pertama Anda untuk mulai melakukan transaksi.</p>
                                    <a href="{{ route('customer.orders.create') }}" class="app-btn-accent mt-5">Buat Pesanan</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($orders->hasPages())
            <div class="border-t border-slate-200 px-6 py-4">{{ $orders->links() }}</div>
        @endif
    </div>
</div>
@endsection
