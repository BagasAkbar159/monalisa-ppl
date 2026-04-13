@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Peternak</h1>

    <p><strong>Kode:</strong> {{ $farmer->code }}</p>
    <p><strong>Nama:</strong> {{ $farmer->name }}</p>
    <p><strong>Alamat:</strong> {{ $farmer->address }}</p>
    <p><strong>No HP:</strong> {{ $farmer->phone }}</p>
    <p><strong>Status:</strong> {{ $farmer->is_active ? 'Aktif' : 'Nonaktif' }}</p>

    <a href="{{ route('admin.farmers.index') }}">Kembali</a>
</div>
@endsection