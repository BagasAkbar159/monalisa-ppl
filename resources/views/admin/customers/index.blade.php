@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <h1 class="app-page-title">Data Customer</h1>
            <p class="app-page-subtitle">
                Kelola akun customer, status verifikasi, dan data perusahaan yang terdaftar di MONALISA.
            </p>
        </div>

        <a href="{{ route('admin.customers.create') }}" class="app-btn-accent">
            Tambah Customer
        </a>
    </div>

    <div class="grid gap-4 md:grid-cols-3">
        <div class="app-card">
            <div class="app-card-body">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold text-slate-500">Data Ditampilkan</p>
                        <p class="mt-3 text-3xl font-extrabold text-slate-900">
                            {{ number_format($customers->count(), 0, ',', '.') }}
                        </p>
                        <p class="mt-1 text-xs text-slate-500">
                            Customer pada halaman ini
                        </p>
                    </div>

                    <div class="rounded-2xl bg-blue-50 p-3 text-blue-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 0 0-5-3.87M9 20H4v-2a4 4 0 0 1 5-3.87m0 0a4 4 0 1 0 0-7.75m8 7.75a4 4 0 1 0 0-7.75" />
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
                    <h2 class="text-lg font-bold text-slate-900">Daftar Customer</h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Data customer terbaru ditampilkan berdasarkan waktu pendaftaran.
                    </p>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full table-fixed divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="w-[20%] px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                            Customer
                        </th>
                        <th class="w-[22%] px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                            Kontak
                        </th>
                        <th class="w-[20%] px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                            Perusahaan
                        </th>
                        <th class="w-[14%] px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                            Verifikasi
                        </th>
                        <th class="w-[12%] px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                            Status
                        </th>
                        <th class="w-[12%] px-6 py-3 text-right text-xs font-bold uppercase tracking-wider text-slate-500">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse($customers as $customer)
                        <tr class="transition hover:bg-slate-50">
                            <td class="w-[20%] px-6 py-4">
                                <div class="min-w-0">
                                    <p class="truncate text-sm font-bold text-slate-900">
                                        {{ $customer->user->name ?? '-' }}
                                    </p>
                                    <p class="mt-1 text-xs text-slate-500">
                                        ID #{{ $customer->id }}
                                    </p>
                                </div>
                            </td>

                            <td class="w-[22%] px-6 py-4">
                                <div class="min-w-0">
                                    <p class="truncate text-sm font-semibold text-slate-900">
                                        {{ $customer->user->email ?? '-' }}
                                    </p>
                                    <p class="mt-1 truncate text-xs text-slate-500">
                                        {{ $customer->user->phone ?? '-' }}
                                    </p>
                                </div>
                            </td>

                            <td class="w-[20%] px-6 py-4">
                                <p class="truncate text-sm font-semibold text-slate-900">
                                    {{ $customer->company_name ?? '-' }}
                                </p>

                                @if ($customer->city || $customer->district)
                                    <p class="mt-1 truncate text-xs text-slate-500">
                                        {{ $customer->district->name ?? '-' }}{{ $customer->city ? ', ' . $customer->city->name : '' }}
                                    </p>
                                @else
                                    <p class="mt-1 text-xs text-slate-400">
                                        Lokasi belum lengkap
                                    </p>
                                @endif
                            </td>

                            <td class="w-[14%] whitespace-nowrap px-6 py-4">
                                @if($customer->is_verified)
                                    <span class="app-badge app-badge-blue">
                                        Terverifikasi
                                    </span>
                                @else
                                    <span class="app-badge app-badge-slate">
                                        Belum
                                    </span>
                                @endif
                            </td>

                            <td class="w-[12%] whitespace-nowrap px-6 py-4">
                                @if($customer->is_active)
                                    <span class="app-badge app-badge-green">
                                        Aktif
                                    </span>
                                @else
                                    <span class="app-badge app-badge-red">
                                        Nonaktif
                                    </span>
                                @endif
                            </td>

                            <td class="w-[12%] whitespace-nowrap px-6 py-4 text-right">
                                <div class="flex justify-end gap-3">
                                    <a href="{{ route('admin.customers.show', $customer) }}"
                                       class="app-badge app-badge-blue">
                                        Detail
                                    </a>

                                    <a href="{{ route('admin.customers.edit', $customer) }}"
                                       class="app-badge app-badge-orange">
                                        Edit
                                    </a>

                                    @if($customer->is_active)
                                        <form action="{{ route('admin.customers.destroy', $customer) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menonaktifkan customer ini?');">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="app-badge app-badge-red">
                                                Nonaktifkan
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-14 text-center">
                                <div class="mx-auto flex max-w-md flex-col items-center">
                                    <div class="rounded-2xl bg-slate-100 p-4 text-slate-500">
                                        <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 0 0-5-3.87M9 20H4v-2a4 4 0 0 1 5-3.87m0 0a4 4 0 1 0 0-7.75m8 7.75a4 4 0 1 0 0-7.75" />
                                        </svg>
                                    </div>

                                    <h3 class="mt-4 text-base font-bold text-slate-900">
                                        Belum ada customer
                                    </h3>

                                    <p class="mt-1 text-sm text-slate-500">
                                        Tambahkan customer pertama agar data transaksi bisa mulai dikelola.
                                    </p>

                                    <a href="{{ route('admin.customers.create') }}" class="app-btn-accent mt-5">
                                        Tambah Customer
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($customers->hasPages())
            <div class="border-t border-slate-200 px-6 py-4">
                {{ $customers->links() }}
            </div>
        @endif
    </div>
</div>
@endsection