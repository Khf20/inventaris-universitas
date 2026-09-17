<?php

namespace Database\Seeders;

use App\Models\User;
<<<<<<< HEAD
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
=======
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
>>>>>>> 5234dcea2670bad4aaf5903da628c34b5b208e9d

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
<<<<<<< HEAD
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
=======
        User::create([
            'name' => 'Admin',
            'email' => 'admin@inventaris.test',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Staff',
            'email' => 'staff@inventaris.test',
            'password' => bcrypt('password'),
>>>>>>> 5234dcea2670bad4aaf5903da628c34b5b208e9d
            'role' => 'staff',
        ]);
    }
}
