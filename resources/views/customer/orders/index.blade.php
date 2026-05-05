@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-slate-50 shadow rounded-lg p-6 border border-slate-200">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Pesanan Saya</h1>
                <p class="text-sm text-gray-500">Daftar pesanan ayam yang telah Anda buat.</p>
            </div>
            <a href="{{ route('customer.orders.create') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700">
                Buat Pesanan
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 rounded-md bg-green-100 border border-green-300 text-green-800 px-4 py-3">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Kode</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Tanggal</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Jumlah Ayam</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Estimasi Berat</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Estimasi Total</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($orders as $order)
                        <tr>
                            <td class="px-4 py-3 text-sm text-gray-800">{{ $order->order_code }}</td>
                            <td class="px-4 py-3 text-sm text-gray-800">{{ $order->order_date->format('d-m-Y') }}</td>
                            <td class="px-4 py-3 text-sm text-gray-800">{{ $order->quantity_chicken }}</td>
                            <td class="px-4 py-3 text-sm text-gray-800">{{ number_format($order->estimated_weight_kg, 2, ',', '.') }} kg</td>
                            <td class="px-4 py-3 text-sm text-gray-800">Rp {{ number_format($order->estimated_total, 0, ',', '.') }}</td>
                            <td class="px-4 py-3 text-sm text-gray-800">
                                <span class="px-2 py-1 text-xs rounded-full bg-slate-100 text-slate-700">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm text-center">
                                <a href="{{ route('customer.orders.show', $order->id) }}"
                                   class="text-blue-600 hover:underline">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-6 text-center text-sm text-gray-500">
                                Belum ada pesanan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection