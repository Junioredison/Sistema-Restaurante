<?php

namespace Database\Seeders;

use App\Models\Permiso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permiso::create(attributes: [ 'nombre' => 'rol' ]);
        Permiso::create(attributes: [ 'nombre' => 'permiso' ]);
        Permiso::create(attributes: [ 'nombre' => 'user' ]);
        Permiso::create(attributes: [ 'nombre' => 'categoria' ]);
        Permiso::create(attributes: [ 'nombre' => 'producto' ]);
        Permiso::create(attributes: [ 'nombre' => 'mesa' ]);
        Permiso::create(attributes: [ 'nombre' => 'pedido' ]);
        Permiso::create(attributes: [ 'nombre' => 'recibo' ]);
        


    }
}
