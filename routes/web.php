<?php

use App\Models\Permiso;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MesaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PermisoController;

Route::get("/",[AuthController::class,'welcome'])->name('welcome');
Route::get("/login",[AuthController::class,'loginView'])->name('login');
Route::post("/login",[AuthController::class,'login'])->name('sendlogin');

Route::get("/logout",[AuthController::class,'logout'])->name('logout');

    Route::prefix('/rol')->middleware('rolMiddleware')-> group(function () { 
    Route::get("/",[RolController::class,'index'])->name('mostrar.rol');
    //  creación del nuevo rol
    Route::get("/crear",[RolController::class,'indexStore'])->name('index.crear.rol');
    Route::post("/crear",[RolController::class,'store'])->name('crear.rol');
    //modificación del rol
    Route::get("/modificar",[RolController::class,'indexUpdate'])->name('index.editar.rol');
    Route::post("/modificarPost",[RolController::class,'update'])->name('editar.rol');
    Route::post("/eliminar",[RolController::class,'destroy'])->name('eliminar.rol');
});
    Route::prefix('/usuario')->middleware('userMiddleware')-> group(function () { 
    Route::get("/",[UserController::class,'index'])->name('mostrar.usuario');
    //  creación del nuevo usuario
    Route::get("/crear",[UserController::class,'indexStore'])->name('index.crear.usuario');
    Route::post("/crear",[UserController::class,'store'])->name('crear.usuario');
    //modificación del usuario
    Route::get("/modificar",[UserController::class,'indexUpdate'])->name('index.editar.usuario');
    Route::post("/modificarPost",[UserController::class,'update'])->name('editar.usuario');

    Route::post("/eliminar",[UserController::class,'destroy'])->name('eliminar.usuario');
});

Route::prefix('/permiso')->middleware('permisoMiddleware')-> group(function () { 
    Route::get("/",[PermisoController::class,'index'])->name('mostrar.permiso');
    Route::post("/",[PermisoController::class,'store'])->name('crear.permiso');
    Route::patch("/",[PermisoController::class,'update'])->name('editar.permiso');
    Route::delete("/",[PermisoController::class,'destroy'])->name('eliminar.permiso');
});

Route::prefix('/mesa')-> group(function () { 
    Route::get("/",[MesaController::class,'index'])->name('mostrar.mesa');
    Route::post("/",[MesaController::class,'store'])->name('crear.mesa');
    Route::post("/editar",[MesaController::class,'update'])->name('editar.mesa');
    Route::post("/eliminar",[MesaController::class,'destroy'])->name('eliminar.mesa');
});

Route::prefix('/pedido')->group(function () { 
    Route::get("/", [PedidoController::class, 'index'])->name('mostrar.pedido');
    Route::post("/", [PedidoController::class, 'store'])->name('crear.pedido');
    Route::post("/editar", [PedidoController::class, 'update'])->name('editar.pedido');
    Route::post("/eliminar", [PedidoController::class, 'destroy'])->name('eliminar.pedido');
    Route::post('/cambiar-estado', [PedidoController::class, 'cambiarEstado'])->name('cambiar.estado.pedido');

});


Route::prefix('/menu')-> group(function () { 
    Route::get("/",[MenuController::class,'index'])->name('mostrar.menu');
    Route::post("/",[MenuController::class,'store'])->name('crear.menu');
    Route::post("/editar",[MenuController::class,'update'])->name('editar.menu');
    Route::post("/eliminar",[MenuController::class,'destroy'])->name('eliminar.menu');
});