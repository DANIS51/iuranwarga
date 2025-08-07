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
    }
}
