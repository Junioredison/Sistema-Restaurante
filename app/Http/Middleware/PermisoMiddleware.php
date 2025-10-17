<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\RolPermiso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class PermisoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Cache::get('persona');
        if (!$user) {
            return redirect()->route('login');
        }
        $permisos = RolPermiso::where('rol_id',$user->rol_id)->select('permiso_id')->get();

        foreach ($permisos as $permiso) {

            if($permiso->permiso_id == "2"){
            return $next($request);
            }
        
        }
            return back()->with('aurorizacion','No tienes permisos para acceder a esta sección');
      
    }
}
