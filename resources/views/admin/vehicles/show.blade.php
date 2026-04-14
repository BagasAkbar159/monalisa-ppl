@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Kendaraan</h1>

    <p><strong>No Polisi:</strong> {{ $vehicle->plate_number }}</p>
    <p><strong>Jenis:</strong> {{ $vehicle->type }}</p>
    <p><strong>Merek:</strong> {{ $vehicle->brand ?? '-' }}</p>
    <p><strong>Kapasitas (Kg):</strong> {{ $vehicle->capacity_kg ?? '-' }}</p>
    <p><strong>Status Kendaraan:</strong> {{ $vehicle->status }}</p>
    <p><strong>Status Aktif:</strong> {{ $vehicle->is_active ? 'Aktif' : 'Nonaktif' }}</p>

    <a href="{{ route('admin.vehicles.index') }}">Kembali</a>
</div>
@endsection