@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-4xl space-y-6">
    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <h1 class="app-page-title">Edit Pesanan</h1>
            <p class="app-page-subtitle">
                Perbarui data pesanan {{ $order->order_code }}. Pesanan dibatalkan tidak dapat diedit.
            </p>
        </div>

        <a href="{{ route('admin.orders.index') }}" class="app-btn-secondary">
            Kembali
        </a>
    </div>

    <div class="app-card">
        <div class="app-card-body">
            <form action="{{ route('admin.orders.update', $order) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid gap-5 md:grid-cols-2">
                    <div class="md:col-span-2">
                        <label for="customer_id" class="app-form-label">Customer</label>
                        <select id="customer_id" name="customer_id" class="app-form-input" required>
                            <option value="">Pilih Customer</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}" @selected(old('customer_id', $order->customer_id) == $customer->id)>
                                    {{ $customer->company_name ?? '-' }} - {{ $customer->user->name ?? '-' }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="order_date" class="app-form-label">Tanggal Pesanan</label>
                        <input
                            id="order_date"
                            type="date"
                            name="order_date"
                            value="{{ old('order_date', $order->order_date?->format('Y-m-d')) }}"
                            class="app-form-input"
                            required
                        >
                    </div>

                    <div>
                        <label for="status" class="app-form-label">Status</label>
                        <select id="status" name="status" class="app-form-input" required>
                            <option value="masuk" @selected(old('status', $order->status) === 'masuk')>
                                Masuk
                            </option>
                            <option value="diproses" @selected(old('status', $order->status) === 'diproses')>
                                Diproses
                            </option>
                            <option value="dikirim" @selected(old('status', $order->status) === 'dikirim')>
                                Dikirim
                            </option>
                            <option value="selesai" @selected(old('status', $order->status) === 'selesai')>
                                Selesai
                            </option>
                        </select>
                        <p class="app-form-help">
                            Pembatalan pesanan dilakukan melalui tombol Batalkan di halaman daftar/detail pesanan.
                        </p>
                    </div>

                    <div>
                        <label for="quantity_chicken" class="app-form-label">Jumlah Ayam</label>
                        <input
                            id="quantity_chicken"
                            type="number"
                            name="quantity_chicken"
                            value="{{ old('quantity_chicken', $order->quantity_chicken) }}"
                            class="app-form-input"
                            min="1"
                            required
                        >
                    </div>

                    <div>
                        <label for="estimated_weight_kg" class="app-form-label">Estimasi Berat (kg)</label>
                        <input
                            id="estimated_weight_kg"
                            type="number"
                            step="0.01"
                            name="estimated_weight_kg"
                            value="{{ old('estimated_weight_kg', $order->estimated_weight_kg) }}"
                            class="app-form-input"
                            min="0.01"
                            required
                        >
                    </div>

                    <div>
                        <label for="price_per_kg" class="app-form-label">Harga per Kg</label>
                        <input
                            id="price_per_kg"
                            type="number"
                            step="0.01"
                            name="price_per_kg"
                            value="{{ old('price_per_kg', $order->price_per_kg) }}"
                            class="app-form-input"
                            min="0"
                            required
                        >
                    </div>

                    <div>
                        <label class="app-form-label">Estimasi Total</label>
                        <div id="estimated-total-preview" class="flex min-h-[42px] items-center rounded-xl border border-slate-200 bg-slate-50 px-4 text-sm font-bold text-slate-900">
                            Rp {{ number_format($order->estimated_total ?? 0, 0, ',', '.') }}
                        </div>
                        <p class="app-form-help">
                            Dihitung dari estimasi berat × harga per kg.
                        </p>
                    </div>

                    <div class="md:col-span-2">
                        <label for="notes" class="app-form-label">Catatan</label>
                        <textarea
                            id="notes"
                            name="notes"
                            rows="4"
                            class="app-form-input"
                        >{{ old('notes', $order->notes) }}</textarea>
                    </div>
                </div>

                <div class="flex flex-wrap items-center justify-between gap-3 border-t border-slate-200 pt-6">
                    <div class="flex flex-wrap gap-3">
                        <button type="submit" class="app-btn-primary">
                            Simpan Perubahan
                        </button>

                        <a href="{{ route('admin.orders.index') }}" class="app-btn-secondary">
                            Batal
                        </a>
                    </div>

                    <p class="text-sm text-slate-500">
                        Gunakan halaman daftar/detail pesanan untuk membatalkan pesanan.
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const weightInput = document.querySelector('[name="estimated_weight_kg"]');
    const priceInput = document.querySelector('[name="price_per_kg"]');
    const totalPreview = document.querySelector('#estimated-total-preview');

    function formatRupiah(value) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            maximumFractionDigits: 0
        }).format(value || 0);
    }

    function updateTotal() {
        const weight = parseFloat(weightInput?.value || 0);
        const price = parseFloat(priceInput?.value || 0);
        const total = weight * price;

        if (totalPreview) {
            totalPreview.textContent = formatRupiah(total);
        }
    }

    weightInput?.addEventListener('input', updateTotal);
    priceInput?.addEventListener('input', updateTotal);
    updateTotal();
</script>
@endsection