<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@monalisa.com'],
            [
                'name' => 'Admin MONALISA',
                'password' => Hash::make('password123'),
            ]
        );

        $admin->assignRole('admin');
    }
}