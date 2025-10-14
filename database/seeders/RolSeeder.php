<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Rol;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Rol::create(attributes: [ 'nombre' => 'Administrador' ]);
       Rol::create(attributes: [ 'nombre' => 'Mesero' ]);
       Rol::create(attributes: [ 'nombre' => 'Cajero' ]);
      
    }
}
