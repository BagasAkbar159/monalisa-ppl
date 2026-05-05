@extends('layouts.app')

@section('content')
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

<div class="mx-auto max-w-4xl space-y-6">
    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <h1 class="app-page-title">Detail Pesanan</h1>
            <p class="app-page-subtitle">Informasi pesanan {{ $order->order_code }}.</p>
        </div>

        <a href="{{ route('customer.orders.index') }}" class="app-btn-secondary">Kembali</a>
    </div>

    <div class="app-card">
        <div class="app-card-body">
            <div class="flex flex-col justify-between gap-4 border-b border-slate-200 pb-6 sm:flex-row sm:items-start">
                <div>
                    <p class="text-sm font-semibold text-slate-500">Kode Pesanan</p>
                    <p class="mt-1 text-2xl font-extrabold text-slate-900">{{ $order->order_code }}</p>
                </div>

                <span class="app-badge {{ $statusClass }}">{{ ucfirst($order->status) }}</span>
            </div>

            <div class="mt-6 grid gap-5 md:grid-cols-2">
                <div class="rounded-2xl bg-slate-50 p-4">
                    <p class="text-sm text-slate-500">Tanggal Pesanan</p>
                    <p class="mt-1 font-bold text-slate-900">{{ $order->order_date?->format('d M Y') ?? '-' }}</p>
                </div>

                <div class="rounded-2xl bg-slate-50 p-4">
                    <p class="text-sm text-slate-500">Jumlah Ayam</p>
                    <p class="mt-1 font-bold text-slate-900">{{ number_format($order->quantity_chicken, 0, ',', '.') }} ekor</p>
                </div>

                <div class="rounded-2xl bg-slate-50 p-4">
                    <p class="text-sm text-slate-500">Estimasi Berat</p>
                    <p class="mt-1 font-bold text-slate-900">{{ number_format($order->estimated_weight_kg, 2, ',', '.') }} kg</p>
                </div>

                <div class="rounded-2xl bg-slate-50 p-4">
                    <p class="text-sm text-slate-500">Harga per Kg</p>
                    <p class="mt-1 font-bold text-slate-900">Rp {{ number_format($order->price_per_kg, 0, ',', '.') }}</p>
                </div>

                <div class="rounded-2xl bg-[#102C4D] p-4 text-white md:col-span-2">
                    <p class="text-sm text-slate-200">Estimasi Total</p>
                    <p class="mt-1 text-xl font-extrabold">Rp {{ number_format($order->estimated_total, 0, ',', '.') }}</p>
                </div>

                <div class="rounded-2xl bg-slate-50 p-4 md:col-span-2">
                    <p class="text-sm text-slate-500">Catatan</p>
                    <p class="mt-1 text-sm leading-6 text-slate-800">{{ $order->notes ?? '-' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
