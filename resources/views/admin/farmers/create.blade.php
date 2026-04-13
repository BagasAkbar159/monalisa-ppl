@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Peternak</h1>

    @if ($errors->any())
        <div style="margin-bottom: 15px; padding: 10px; background: #fee2e2; color: #991b1b;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.farmers.store') }}" method="POST">
        @csrf

        <div>
            <label>Kode</label><br>
            <input type="text" name="code" value="{{ old('code') }}">
        </div>

        <div>
            <label>Nama</label><br>
            <input type="text" name="name" value="{{ old('name') }}">
        </div>

        <div>
            <label>Alamat</label><br>
            <textarea name="address">{{ old('address') }}</textarea>
        </div>

        <div>
            <label>No HP</label><br>
            <input type="text" name="phone" value="{{ old('phone') }}">
        </div>

        <div>
            <label>Status</label><br>
            <select name="is_active">
                <option value="1">Aktif</option>
                <option value="0">Nonaktif</option>
            </select>
        </div>

        <br>
        <button type="submit">Simpan</button>
        <a href="{{ route('admin.farmers.index') }}">Kembali</a>
    </form>
</div>
@endsection