@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-100">Dashboard Admin</h1>
        <p class="text-sm text-gray-300">Ringkasan data operasional MONALISA.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4 mb-8">
        <div class="bg-slate-50 shadow rounded-lg p-5 border border-slate-200">
            <p class="text-sm text-gray-500">Total Stock Ayam</p>
            <p class="text-3xl font-bold text-blue-700">{{ $totalChicken }}</p>
            <p class="text-sm text-gray-400 mt-1">ekor</p>
        </div>

        <div class="bg-slate-50 shadow rounded-lg p-5 border border-slate-200">
            <p class="text-sm text-gray-500">Total Berat Stock</p>
            <p class="text-3xl font-bold text-green-700">{{ number_format($totalWeight ?? 0, 2, ',', '.') }}</p>
            <p class="text-sm text-gray-400 mt-1">kg</p>
        </div>

        <div class="bg-slate-50 shadow rounded-lg p-5 border border-slate-200">
            <p class="text-sm text-gray-500">Total Customer</p>
            <p class="text-3xl font-bold text-purple-700">{{ $totalCustomers }}</p>
            <p class="text-sm text-gray-400 mt-1">akun customer</p>
        </div>

        <div class="bg-slate-50 shadow rounded-lg p-5 border border-slate-200">
            <p class="text-sm text-gray-500">Total Driver</p>
            <p class="text-3xl font-bold text-orange-700">{{ $totalDrivers }}</p>
            <p class="text-sm text-gray-400 mt-1">akun driver</p>
        </div>
    </div>

    <div class="bg-slate-50 shadow rounded-lg p-6 border border-slate-200">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
            <a href="{{ route('admin.chicken-productions.create') }}"
               class="inline-flex items-center justify-center px-4 py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-semibold">
                Tambah Produksi
            </a>

            <a href="{{ route('admin.stock.index') }}"
               class="inline-flex items-center justify-center px-4 py-3 bg-green-600 text-white rounded-md hover:bg-green-700 font-semibold">
                Lihat Stock
            </a>

            <a href="{{ route('admin.customers.index') }}"
               class="inline-flex items-center justify-center px-4 py-3 bg-purple-600 text-white rounded-md hover:bg-purple-700 font-semibold">
                Data Customer
            </a>

            <a href="{{ route('admin.drivers.index') }}"
               class="inline-flex items-center justify-center px-4 py-3 bg-orange-600 text-white rounded-md hover:bg-orange-700 font-semibold">
                Data Driver
            </a>
        </div>
    </div>
</div>
@endsection