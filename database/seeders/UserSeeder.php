<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'John',
            'username' => 'john123',
            'email' => 'admin@example.com',
            'password' => Hash::make('rahasia123'),
            'level' => 'admin',
        ]);

        User::create([
            'name' => 'danis',
            'username' => 'danis',
            'email' => 'danis@gmail.com',
            'password' => Hash::make('123456'),
            'level' => 'admin',
        ]);

        User::create([
            'name' => 'Officer User',
            'username' => 'officer',
            'email' => 'officer@example.com',
            'password' => Hash::make('officer123'),
            'level' => 'officer',
        ]);
         User::create([
            'name' => 'admin',
            'username' => 'admin1',
            'email' => 'admin1@example.com',
            'password' => Hash::make('123456'),
            'level' => 'admin',
        ]);
    }
}
