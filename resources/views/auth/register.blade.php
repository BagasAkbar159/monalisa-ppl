<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" />
            <x-text-input
                id="name"
                class="block mt-1 w-full"
                type="text"
                name="name"
                :value="old('name')"
                required
                autofocus
                autocomplete="name"
            />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input
                id="email"
                class="block mt-1 w-full"
                type="email"
                name="email"
                :value="old('email')"
                required
                autocomplete="username"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="phone" :value="__('Nomor HP')" />
            <x-text-input
                id="phone"
                class="block mt-1 w-full"
                type="text"
                name="phone"
                :value="old('phone')"
                required
                autocomplete="tel"
            />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="company_name" :value="__('Nama Customer / Perusahaan')" />
            <x-text-input
                id="company_name"
                class="block mt-1 w-full"
                type="text"
                name="company_name"
                :value="old('company_name')"
                required
            />
            <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="city_id" :value="__('Kabupaten / Kota')" />
            <select id="city_id" name="city_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                <option value="">-- Pilih Kabupaten / Kota --</option>
                @foreach($cities as $city)
                    <option value="{{ $city->id }}" {{ old('city_id') == $city->id ? 'selected' : '' }}>
                        {{ $city->name }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('city_id')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="district_id" :value="__('Kecamatan')" />
            <select id="district_id" name="district_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                <option value="">-- Pilih Kecamatan --</option>
            </select>
            <x-input-error :messages="$errors->get('district_id')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="village_name" :value="__('Desa / Kelurahan')" />
            <x-text-input
                id="village_name"
                class="block mt-1 w-full"
                type="text"
                name="village_name"
                :value="old('village_name')"
                required
            />
            <x-input-error :messages="$errors->get('village_name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="detail_address" :value="__('Detail Alamat')" />
            <textarea
                id="detail_address"
                name="detail_address"
                rows="4"
                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                required
            >{{ old('detail_address') }}</textarea>
            <x-input-error :messages="$errors->get('detail_address')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input
                id="password"
                class="block mt-1 w-full"
                type="password"
                name="password"
                required
                autocomplete="new-password"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
            <x-text-input
                id="password_confirmation"
                class="block mt-1 w-full"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
            />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a
                class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('login') }}"
            >
                {{ __('Sudah punya akun?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const citySelect = document.getElementById('city_id');
            const districtSelect = document.getElementById('district_id');
            const oldDistrictId = "{{ old('district_id') }}";

            function loadDistricts(cityId, selectedDistrictId = null) {
                districtSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';

                if (!cityId) {
                    return;
                }

                fetch(`/locations/cities/${cityId}/districts`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(district => {
                            const option = document.createElement('option');
                            option.value = district.id;
                            option.textContent = district.name;

                            if (selectedDistrictId && selectedDistrictId == district.id) {
                                option.selected = true;
                            }

                            districtSelect.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error('Gagal memuat data kecamatan:', error);
                    });
            }

            citySelect.addEventListener('change', function () {
                loadDistricts(this.value);
            });

            if (citySelect.value) {
                loadDistricts(citySelect.value, oldDistrictId);
            }
        });
    </script>
</x-guest-layout>