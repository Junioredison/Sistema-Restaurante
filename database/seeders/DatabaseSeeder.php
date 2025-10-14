<?php

namespace Database\Seeders;

use App\Models\Rol;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  
    public function run(): void
    {
        $this->call([
            RolSeeder::class,
            UserSeeder::class,
            PermisoSeeder::class,
            RolPermisoSeeder::class

        ]);
    }
}
