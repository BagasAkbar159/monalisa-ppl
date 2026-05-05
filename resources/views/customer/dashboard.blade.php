@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-100">Dashboard Customer</h1>
        <p class="text-sm text-gray-300">
            Selamat datang, {{ auth()->user()->name }}. Kelola pesanan ayam Anda di sini.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
        <div class="bg-slate-50 shadow rounded-lg p-5 border border-slate-200">
            <p class="text-sm text-gray-500">Total Pesanan Saya</p>
            <p class="text-3xl font-bold text-blue-700">
                {{ auth()->user()->customer?->orders()->count() ?? 0 }}
            </p>
            <p class="text-sm text-gray-400 mt-1">pesanan</p>
        </div>

        <div class="bg-slate-50 shadow rounded-lg p-5 border border-slate-200">
            <p class="text-sm text-gray-500">Pesanan Status Masuk</p>
            <p class="text-3xl font-bold text-green-700">
                {{ auth()->user()->customer?->orders()->where('status', 'masuk')->count() ?? 0 }}
            </p>
            <p class="text-sm text-gray-400 mt-1">menunggu diproses</p>
        </div>
    </div>

    <div class="bg-slate-50 shadow rounded-lg p-6 border border-slate-200">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
            <a href="{{ route('customer.orders.create') }}"
               class="inline-flex items-center justify-center px-4 py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-semibold">
                Buat Pesanan
            </a>

            <a href="{{ route('customer.orders.index') }}"
               class="inline-flex items-center justify-center px-4 py-3 bg-green-600 text-white rounded-md hover:bg-green-700 font-semibold">
                Pesanan Saya
            </a>

            <a href="{{ route('customer.profile') }}"
               class="inline-flex items-center justify-center px-4 py-3 bg-slate-600 text-white rounded-md hover:bg-slate-700 font-semibold">
                Profil Saya
            </a>
        </div>
    </div>
</div>
@endsection