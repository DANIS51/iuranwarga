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
            'name' => 'admin',
            'username' => 'admin1',
            'email' => 'admin1@example.com',
            'password' => Hash::make('123456'),
            'level' => 'admin',
        ]);


    }
}
