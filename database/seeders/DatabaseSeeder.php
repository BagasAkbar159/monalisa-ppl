<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // $this->call([
        //     RoleSeeder::class,
        //     AdminUserSeeder::class,
        // ]);

        $this->call([
            RoleSeeder::class,
            DirekturUserSeeder::class,
        ]);

    //     $this->call([
    //         CitySeeder::class,
    //         DistrictSeeder::class,
    //     ]);
    }
}