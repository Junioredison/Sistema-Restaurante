<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    
    public function index() 
    {
       return view('rol.index');
    }

    public function store(Request $request)
    {
        //
    }

  
    public function update(Request $request, Rol $rol)
    {
        //
    }

    public function destroy(Rol $rol)
    {
        //
    }
}
