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
            'login' => 'client1',
            'password' => Hash::make('123456'),
            'nom' => 'Test',
            'prenom' => 'Client',
            'email' => 'client1@mail.com',
            'tel' => '0600000000',
            'role' => 'USER',
        ]);
    }
}