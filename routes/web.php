<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use App\Http\Controllers\PermisoController;
use App\Models\Permiso;

Route::get("/",[AuthController::class,'welcome'])->name('welcome');
Route::get("/login",[AuthController::class,'loginView'])->name('login');
Route::post("/login",[AuthController::class,'login'])->name('sendlogin');

Route::get("/logout",[AuthController::class,'logout'])->name('logout');

Route::prefix('rol')->middleware('rolMiddleware')-> group(function () { 
    Route::get("/",[RolController::class,'index'])->name('mostrar.rol');
    Route::post("/",[RolController::class,'store'])->name('crear.rol');
    Route::patch("/",[RolController::class,'update'])->name('editar.rol');
    Route::delete("/",[RolController::class,'destroy'])->name('eliminar.rol');
});

Route::prefix('permiso')->middleware('permisoMiddleware')-> group(function () { 
    Route::get("/",[PermisoController::class,'index'])->name('mostrar.permiso');
    Route::post("/",[PermisoController::class,'store'])->name('crear.permiso');
    Route::patch("/",[PermisoController::class,'update'])->name('editar.permiso');
    Route::delete("/",[PermisoController::class,'destroy'])->name('eliminar.permiso');
});

