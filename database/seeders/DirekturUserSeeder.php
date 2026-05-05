<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DirekturUserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'direktur@monalisa.test'],
            [
                'name' => 'Direktur MONALISA',
                'phone' => '080000000002',
                'password' => Hash::make('password'),
                'is_active' => true,
            ]
        );

        $user->assignRole('direktur');
    }
}