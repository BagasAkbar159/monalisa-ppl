@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Tambah Driver</h1>

        @if ($errors->any())
            <div class="mb-4 rounded-md bg-red-100 border border-red-300 text-red-800 px-4 py-3">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.drivers.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Akun</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('name') border-red-500 @enderror"
                >
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('email') border-red-500 @enderror"
                >
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">No HP</label>
                <input
                    type="text"
                    id="phone"
                    name="phone"
                    value="{{ old('phone') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('phone') border-red-500 @enderror"
                >
                @error('phone')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('password') border-red-500 @enderror"
                >
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                >
            </div>

            <div>
                <label for="license_number" class="block text-sm font-medium text-gray-700">Nomor SIM</label>
                <input
                    type="text"
                    id="license_number"
                    name="license_number"
                    value="{{ old('license_number') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('license_number') border-red-500 @enderror"
                >
                @error('license_number')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="license_type" class="block text-sm font-medium text-gray-700">Jenis SIM</label>
                <input
                    type="text"
                    id="license_type"
                    name="license_type"
                    value="{{ old('license_type') }}"
                    placeholder="Contoh: SIM A / SIM B1"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('license_type') border-red-500 @enderror"
                >
                @error('license_type')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="license_expiry_date" class="block text-sm font-medium text-gray-700">Masa Berlaku SIM</label>
                <input
                    type="date"
                    id="license_expiry_date"
                    name="license_expiry_date"
                    value="{{ old('license_expiry_date') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('license_expiry_date') border-red-500 @enderror"
                >
                @error('license_expiry_date')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
                <textarea
                    id="address"
                    name="address"
                    rows="4"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('address') border-red-500 @enderror"
                >{{ old('address') }}</textarea>
                @error('address')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status Driver</label>
                <select
                    id="status"
                    name="status"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('status') border-red-500 @enderror"
                >
                    <option value="available" {{ old('status', 'available') == 'available' ? 'selected' : '' }}>Available</option>
                    <option value="on_delivery" {{ old('status') == 'on_delivery' ? 'selected' : '' }}>On Delivery</option>
                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="notes" class="block text-sm font-medium text-gray-700">Catatan</label>
                <textarea
                    id="notes"
                    name="notes"
                    rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('notes') border-red-500 @enderror"
                >{{ old('notes') }}</textarea>
                @error('notes')
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
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700"
                >
                    Simpan
                </button>

                <a href="{{ route('admin.drivers.index') }}"
                   class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection