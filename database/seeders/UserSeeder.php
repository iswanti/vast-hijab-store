<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'superadmin@vasthijab.com'],
            [
                'name' => 'Super Admin',
                'nomor_telepon' => '081234567890',
                'password' => Hash::make('password'),
                'role' => 'superadmin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'owner@vasthijab.com'],
            [
                'name' => 'Owner Vast Hijab',
                'nomor_telepon' => '081234567891',
                'password' => Hash::make('password'),
                'role' => 'owner',
            ]
        );
    }
}