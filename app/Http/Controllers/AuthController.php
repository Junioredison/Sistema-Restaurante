<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class AuthController extends Controller
{
    public function welcome() {
        return view('welcome');
    }

    public function loginView() {
        return view('login');
    }

    public function login(Request $request) {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
       $user = User::where('username',$request->username)->first();
         if(! $user){
            return back()->with('errorUser','Usuario no existe vuelve a intentarlo');
         }
            $credentials = $request->only('username', 'password');
            
            if (Auth::guard('web')->attempt($credentials)) {
                Cache::put('persona',$user);
                return redirect()->route('mostrar.rol');
            }
            else
            {
                return back()->with('password','Contraseña incorrecta vuelve a intentarlo');
            }
    }
    public function logout() {
       
        Cache::forget('persona');
        return redirect()->route('welcome');
        
    }
            
}
