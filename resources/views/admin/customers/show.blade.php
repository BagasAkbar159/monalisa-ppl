@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Detail Customer</h1>

        <div class="space-y-4">
            <div>
                <p class="text-sm text-gray-500">Nama Akun:</p>
                <p class="text-lg font-semibold text-gray-800">
                    {{ $customer->user->name }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Email:</p>
                <p class="text-lg font-semibold text-gray-800">
                    {{ $customer->user->email }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">No HP:</p>
                <p class="text-lg font-semibold text-gray-800">
                    {{ $customer->user->phone ?? '-' }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Nama Perusahaan:</p>
                <p class="text-lg font-semibold text-gray-800">
                    {{ $customer->company_name ?? '-' }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Alamat:</p>
                <p class="text-lg font-semibold text-gray-800">
                    {{ $customer->address ?? '-' }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Terverifikasi:</p>
                <p class="text-lg font-semibold text-gray-800">
                    {{ $customer->is_verified ? 'Ya' : 'Tidak' }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Waktu Verifikasi:</p>
                <p class="text-lg font-semibold text-gray-800">
                    {{ $customer->verified_at ? $customer->verified_at->format('d-m-Y H:i:s') : '-' }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Status Aktif:</p>
                <p class="text-lg font-semibold text-gray-800">
                    {{ $customer->is_active ? 'Aktif' : 'Nonaktif' }}
                </p>
            </div>
        </div>

        <div class="mt-6 flex gap-3">
            <a href="{{ route('admin.customers.edit', $customer->id) }}"
               class="px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600">
                Edit
            </a>

            <a href="{{ route('admin.customers.index') }}"
               class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                Kembali
            </a>
        </div>
    </div>
</div>
@endsection