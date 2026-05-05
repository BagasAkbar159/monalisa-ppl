<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $cities = [
            'Kabupaten Kediri',
            'Kota Kediri',
            'Kabupaten Blitar',
            'Kota Blitar',
            'Kabupaten Tulungagung',
            'Kabupaten Nganjuk',
            'Kabupaten Jombang',
            'Kabupaten Malang',
            'Kota Malang',
            'Kabupaten Pasuruan',
            'Kota Pasuruan',
            'Kabupaten Mojokerto',
            'Kota Mojokerto',
            'Kabupaten Sidoarjo',
            'Kota Surabaya',
            'Kabupaten Gresik',
            'Kabupaten Lamongan',
            'Kabupaten Probolinggo',
            'Kota Probolinggo',
            'Kabupaten Jember',
            'Kabupaten Banyuwangi',
        ];

        foreach ($cities as $cityName) {
            City::firstOrCreate(['name' => $cityName]);
        }
    }
}