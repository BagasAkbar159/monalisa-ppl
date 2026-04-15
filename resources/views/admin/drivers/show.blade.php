@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Driver</h1>

    <p><strong>Nama Akun:</strong> {{ $driver->user->name }}</p>
    <p><strong>Email:</strong> {{ $driver->user->email }}</p>
    <p><strong>No HP:</strong> {{ $driver->user->phone ?? '-' }}</p>
    <p><strong>Nomor SIM:</strong> {{ $driver->license_number }}</p>
    <p><strong>Jenis SIM:</strong> {{ $driver->license_type ?? '-' }}</p>
    <p><strong>Masa Berlaku SIM:</strong> {{ $driver->license_expiry_date ? $driver->license_expiry_date->format('d-m-Y') : '-' }}</p>
    <p><strong>Alamat:</strong> {{ $driver->address ?? '-' }}</p>
    <p><strong>Status Driver:</strong> {{ $driver->status }}</p>
    <p><strong>Catatan:</strong> {{ $driver->notes ?? '-' }}</p>
    <p><strong>Status Aktif:</strong> {{ $driver->is_active ? 'Aktif' : 'Nonaktif' }}</p>

    <a href="{{ route('admin.drivers.index') }}">Kembali</a>
</div>
@endsection