<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Rol;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function index() 
    {
        $datos = User::get();       
        $datos = $datos->map->toShow();
        
        return view("user.index",compact('datos'));
    }
    public function indexStore() 
    {
        $roles =Rol::get();
        return view('user.crear', compact('roles')); 
    }
    public function indexUpdate(Request $request) 
    {
        $dato = User::find($request->id);
        $roles =Rol::get();
        return view('user.editar', compact('dato', 'roles')); 
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
            'username' => 'required|string|max:30|unique:users,username',
            'email' => 'required|string|email|max:100|unique:users,email',
            'password' => 'required|string|min:8|',
            'rol_id' => 'required|exists:rols,id',
        ], $this->rules);

        // 🔹 Creación del nuevo usuario
        $nuevo = [
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password), // encripta la contraseña
            'rol_id' => $request->rol_id,
        ];
                $nuevo = User::create($nuevo);
            }
            catch(ValidationException $e) {
                $mensajes =collect($e->errors())->flatten()->join('');
                return back()->with('error', $mensajes);
            }
            catch(\Exception $e) {
                return back()->with('error', $e->getMessage());
            }
            return  Redirect()->route('mostrar.usuario');
        
    }

    
    public function update(Request $request, User $user)
    {
        try { 
            $modificar = $request->validate( [
                'username' => 'sometimes|string|max:30|unique:users,username',
                'email' => 'sometimes|string|email|max:100|unique:users,email',
                'password' => 'sometimes|string|min:8|',
                'rol_id' => 'sometimes|exists:rols,id',
            ], $this->rules);
            $dato = User::find( $request->id);
            $dato->update( $modificar);
        }
        catch(ValidationException $e) {
            $mensajes =collect( $e->errors())->flatten()->join('');
            return back()->with('error', $mensajes);
}
        catch (\Exception $e) {  
            return back()->with('error', $e->getMessage());
        }  
        return redirect()->route('mostrar.usuario');
        
    }

    public function destroy(Request $request)
    {
        $datos = User::find($request->id);
        $datos->delete();
        return redirect()->route('mostrar.usuario');
    }
    private $rules = [
            'username.required' => 'El nombre de usuario es obligatorio.',
            'username.string'   => 'El nombre de usuario debe ser una cadena de texto válida.',
            'username.max'      => 'El nombre de usuario no puede tener más de 30 caracteres.',
            'username.unique'   => 'Este nombre de usuario ya está registrado.',

            'email.required'    => 'El correo electrónico es obligatorio.',
            'email.string'      => 'El correo electrónico debe ser una cadena válida.',
            'email.email'       => 'Debes ingresar un correo electrónico válido.',
            'email.max'         => 'El correo no puede superar los 100 caracteres.',
            'email.unique'      => 'Este correo electrónico ya está registrado.',

            'password.required' => 'La contraseña es obligatoria.',
            'password.string'   => 'La contraseña debe ser una cadena de texto válida.',
            'password.min'      => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed'=> 'Las contraseñas no coinciden.',

            'rol_id.required'   => 'El campo rol es obligatorio.',
            'rol_id.exists'     => 'El rol seleccionado no existe en la base de datos.',
    ];
}
