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
        User::create(attributes: [
        'Username' => 'admin',
        'Email' => 'admin@email.com',
        'Password' => Hash::make (value:'12345'),
        'Rol_id' => 1
        ]);
    }
}
