@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Customer</h1>

    <p><strong>Nama Akun:</strong> {{ $customer->user->name }}</p>
    <p><strong>Email:</strong> {{ $customer->user->email }}</p>
    <p><strong>No HP:</strong> {{ $customer->user->phone ?? '-' }}</p>
    <p><strong>Nama Perusahaan:</strong> {{ $customer->company_name ?? '-' }}</p>
    <p><strong>Alamat:</strong> {{ $customer->address ?? '-' }}</p>
    <p><strong>Terverifikasi:</strong> {{ $customer->is_verified ? 'Ya' : 'Tidak' }}</p>
    <p><strong>Waktu Verifikasi:</strong> {{ $customer->verified_at ? $customer->verified_at->format('d-m-Y H:i:s') : '-' }}</p>
    <p><strong>Status Aktif:</strong> {{ $customer->is_active ? 'Aktif' : 'Nonaktif' }}</p>

    <a href="{{ route('admin.customers.index') }}">Kembali</a>
</div>
@endsection