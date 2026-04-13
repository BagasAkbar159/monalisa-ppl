@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Data Peternak</h1>

    @if(session('success'))
        <div style="margin-bottom: 15px; padding: 10px; background: #d1fae5; color: #065f46;">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.farmers.create') }}">Tambah Peternak</a>

    <table border="1" cellpadding="10" cellspacing="0" width="100%" style="margin-top: 15px;">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No HP</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($farmers as $farmer)
                <tr>
                    <td>{{ $farmer->code }}</td>
                    <td>{{ $farmer->name }}</td>
                    <td>{{ $farmer->address }}</td>
                    <td>{{ $farmer->phone }}</td>
                    <td>{{ $farmer->is_active ? 'Aktif' : 'Nonaktif' }}</td>
                    <td>
                        <a href="{{ route('admin.farmers.show', $farmer->id) }}">Detail</a> |
                        <a href="{{ route('admin.farmers.edit', $farmer->id) }}">Edit</a> |
                        <form action="{{ route('admin.farmers.destroy', $farmer->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Belum ada data peternak.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 15px;">
        {{ $farmers->links() }}
    </div>
</div>
@endsection