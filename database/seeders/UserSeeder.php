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
            ['email' => 'superadmin@gmail.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('superadmin1234'),
                'role' => 'superadmin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'ownervasthijab@gmail.com'],
            [
                'name' => 'Owner Vast Hijab',
                'password' => Hash::make('ownervasthijab1234'),
                'role' => 'owner',
            ]
        );
    }
}