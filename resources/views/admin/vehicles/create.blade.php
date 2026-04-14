@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Tambah Kendaraan</h1>

        @if ($errors->any())
            <div class="mb-4 rounded-md bg-red-100 border border-red-300 text-red-800 px-4 py-3">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.vehicles.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="plate_number" class="block text-sm font-medium text-gray-700">No Polisi</label>
                <input
                    type="text"
                    id="plate_number"
                    name="plate_number"
                    value="{{ old('plate_number') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('plate_number') border-red-500 @enderror"
                >
                @error('plate_number')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="type" class="block text-sm font-medium text-gray-700">Jenis</label>
                <input
                    type="text"
                    id="type"
                    name="type"
                    value="{{ old('type') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('type') border-red-500 @enderror"
                >
                @error('type')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="brand" class="block text-sm font-medium text-gray-700">Merek</label>
                <input
                    type="text"
                    id="brand"
                    name="brand"
                    value="{{ old('brand') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('brand') border-red-500 @enderror"
                >
                @error('brand')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="capacity_kg" class="block text-sm font-medium text-gray-700">Kapasitas (Kg)</label>
                <input
                    type="number"
                    step="0.01"
                    id="capacity_kg"
                    name="capacity_kg"
                    value="{{ old('capacity_kg') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('capacity_kg') border-red-500 @enderror"
                >
                @error('capacity_kg')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status Kendaraan</label>
                <select
                    id="status"
                    name="status"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('status') border-red-500 @enderror"
                >
                    <option value="">-- Pilih Status --</option>
                    <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
                    <option value="in_use" {{ old('status') == 'in_use' ? 'selected' : '' }}>In Use</option>
                    <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                </select>
                @error('status')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="is_active" class="block text-sm font-medium text-gray-700">Status Aktif</label>
                <select
                    id="is_active"
                    name="is_active"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('is_active') border-red-500 @enderror"
                >
                    <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Nonaktif</option>
                </select>
                @error('is_active')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-3">
                <button
                    type="submit"
                    style="background-color:#2563eb; color:white; padding:10px 16px; border:none; border-radius:6px; cursor:pointer;"
                >
                    Simpan
                </button>

                <a href="{{ route('admin.vehicles.index') }}"
                   class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection