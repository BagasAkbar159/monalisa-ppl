@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Peternak</h1>

        @if ($errors->any())
            <div class="mb-4 rounded-md bg-red-100 border border-red-300 text-red-800 px-4 py-3">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.farmers.update', $farmer->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="code" class="block text-sm font-medium text-gray-700">Kode</label>
                <input
                    type="text"
                    id="code"
                    name="code"
                    value="{{ old('code', $farmer->code) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('code') border-red-500 @enderror"
                >
                @error('code')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $farmer->name) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('name') border-red-500 @enderror"
                >
                @error('name')
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
                >{{ old('address', $farmer->address) }}</textarea>
                @error('address')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">No HP</label>
                <input
                    type="text"
                    id="phone"
                    name="phone"
                    value="{{ old('phone', $farmer->phone) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('phone') border-red-500 @enderror"
                >
                @error('phone')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="is_active" class="block text-sm font-medium text-gray-700">Status</label>
                <select
                    id="is_active"
                    name="is_active"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('is_active') border-red-500 @enderror"
                >
                    <option value="1" {{ old('is_active', $farmer->is_active) == 1 ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ old('is_active', $farmer->is_active) == 0 ? 'selected' : '' }}>Nonaktif</option>
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
                    Update
                </button>

                <a
                    href="{{ route('admin.farmers.index') }}"
                    class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600"
                >
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection