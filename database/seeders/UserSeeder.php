<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(['email' => 'admin@inventaris.test'], [
            'name' => 'Admin Inventaris',
            'email' => 'admin@inventaris.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::updateOrCreate(['email' => 'staff@inventaris.test'], [
            'name' => 'Staff Inventaris',
            'email' => 'staff@inventaris.test',
            'password' => Hash::make('password'),
            'role' => 'staff',
        ]);
    }
}
