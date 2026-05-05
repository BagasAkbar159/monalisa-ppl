<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\District;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    public function run(): void
    {
        $districtsByCity = [
            'Kabupaten Kediri' => [
                'Ngasem',
                'Gampengrejo',
                'Banyakan',
                'Mojo',
                'Semen',
                'Pare',
                'Kras',
                'Papar',
                'Puncu',
                'Plosoklaten',
            ],
            'Kota Kediri' => [
                'Mojoroto',
                'Kota',
                'Pesantren',
            ],
            'Kabupaten Blitar' => [
                'Kanigoro',
                'Talun',
                'Garum',
                'Sutojayan',
                'Wlingi',
            ],
            'Kota Blitar' => [
                'Sananwetan',
                'Kepanjenkidul',
                'Sukorejo',
            ],
            'Kabupaten Tulungagung' => [
                'Tulungagung',
                'Kedungwaru',
                'Ngantru',
                'Boyolangu',
                'Kauman',
            ],
            'Kabupaten Nganjuk' => [
                'Nganjuk',
                'Bagor',
                'Sukomoro',
                'Loceret',
                'Kertosono',
            ],
            'Kabupaten Jombang' => [
                'Jombang',
                'Diwek',
                'Mojowarno',
                'Peterongan',
                'Perak',
            ],
            'Kabupaten Malang' => [
                'Kepanjen',
                'Singosari',
                'Lawang',
                'Pakis',
                'Turen',
            ],
            'Kota Malang' => [
                'Klojen',
                'Lowokwaru',
                'Blimbing',
                'Sukun',
                'Kedungkandang',
            ],
            'Kabupaten Pasuruan' => [
                'Bangil',
                'Beji',
                'Gempol',
                'Pandaan',
                'Purwosari',
            ],
            'Kota Pasuruan' => [
                'Bugul Kidul',
                'Panggungrejo',
                'Purworejo',
                'Gadingrejo',
            ],
            'Kabupaten Mojokerto' => [
                'Mojosari',
                'Sooko',
                'Puri',
                'Ngoro',
                'Trowulan',
            ],
            'Kota Mojokerto' => [
                'Prajurit Kulon',
                'Magersari',
                'Kranggan',
            ],
            'Kabupaten Sidoarjo' => [
                'Sidoarjo',
                'Candi',
                'Buduran',
                'Taman',
                'Waru',
            ],
            'Kota Surabaya' => [
                'Tegalsari',
                'Wonokromo',
                'Rungkut',
                'Sukolilo',
                'Tambaksari',
            ],
            'Kabupaten Gresik' => [
                'Gresik',
                'Kebomas',
                'Manyar',
                'Driyorejo',
                'Cerme',
            ],
            'Kabupaten Lamongan' => [
                'Lamongan',
                'Deket',
                'Paciran',
                'Sukodadi',
                'Babat',
            ],
            'Kabupaten Probolinggo' => [
                'Kraksaan',
                'Paiton',
                'Dringu',
                'Maron',
                'Gending',
            ],
            'Kota Probolinggo' => [
                'Mayangan',
                'Kademangan',
                'Kanigaran',
                'Wonoasih',
                'Kedopok',
            ],
            'Kabupaten Jember' => [
                'Kaliwates',
                'Patrang',
                'Sumbersari',
                'Ajung',
                'Rambipuji',
            ],
            'Kabupaten Banyuwangi' => [
                'Banyuwangi',
                'Genteng',
                'Rogojampi',
                'Kalipuro',
                'Glagah',
            ],
        ];

        foreach ($districtsByCity as $cityName => $districts) {
            $city = City::where('name', $cityName)->first();

            if (!$city) {
                continue;
            }

            foreach ($districts as $districtName) {
                District::firstOrCreate([
                    'city_id' => $city->id,
                    'name' => $districtName,
                ]);
            }
        }
    }
}