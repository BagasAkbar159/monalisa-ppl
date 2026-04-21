@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Produksi Ayam</h1>

        @if ($errors->any())
            <div class="mb-4 rounded-md bg-red-100 border border-red-300 text-red-800 px-4 py-3">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.chicken-productions.update', $chickenProduction->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700">Jumlah Ayam Panen</label>
                <input type="number" name="quantity_chicken"
                       value="{{ old('quantity_chicken', $chickenProduction->quantity_chicken) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" min="1" required>
                <p class="mt-1 text-sm text-gray-500">Berat otomatis dihitung 1,8 kg per ekor.</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Catatan</label>
                <textarea name="notes" rows="4"
                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('notes', $chickenProduction->notes) }}</textarea>
            </div>

            <div class="flex items-center gap-3">
                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Update
                </button>

                <a href="{{ route('admin.chicken-productions.index') }}"
                   class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection