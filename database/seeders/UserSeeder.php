<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
        'username' => 'admin',
        'email' => 'admin@email.com',
        'password' => Hash::make (value:'12345'),
        'rol_id' => 1
        ]);

        User::create([
        'username' => 'prueba',
        'email' => 'prueba@email.com',
        'password' => Hash::make (value:'12345'),
        'rol_id' => 2
        ]);
    }
}
