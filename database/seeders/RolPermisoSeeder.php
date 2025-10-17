<?php

namespace Database\Seeders;

use App\Models\RolPermiso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolPermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {       
        // permisos para el rol Administrador 
            RolPermiso::create( [ 'permiso_id' => 1, 'rol_id' => 1 ]);
            RolPermiso::create( [ 'permiso_id' => 2, 'rol_id' => 1 ]);
            RolPermiso::create( [ 'permiso_id' => 3, 'rol_id' => 1 ]);
            RolPermiso::create( [ 'permiso_id' => 4, 'rol_id' => 1 ]);
            RolPermiso::create( [ 'permiso_id' => 5, 'rol_id' => 1 ]);
        // permisos para el rol Mesero
            RolPermiso::create( [ 'permiso_id' => 6, 'rol_id' => 2 ]);
            RolPermiso::create( [ 'permiso_id' => 7, 'rol_id' => 2 ]);
        // permisos para el rol Cajero
            RolPermiso::create( [ 'permiso_id' => 8, 'rol_id' => 3 ]);
       
            
        
    }
}
