<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'role' => 'admin',
                'status' => 'active',
                'password' => 'password',
            ]
        );

        User::updateOrCreate(
            ['email' => 'petugas@example.com'],
            [
                'name' => 'Petugas User',
                'role' => 'petugas',
                'status' => 'active',
                'password' => 'password',
            ]
        );

        User::updateOrCreate(
            ['email' => 'siswa@example.com'],
            [
                'name' => 'Siswa User',
                'role' => 'siswa',
                'status' => 'active',
                'password' => 'password',
            ]
        );
    }
}
