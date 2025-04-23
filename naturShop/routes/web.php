<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;





Route::get('/dashboard', function () {
    return view('auth.dashboard');
})->middleware('auth')->name('dashboard');


//Prueba borrado de usuario
Route::delete('/user/delete/{id}', [UserController::class, 'delete'])->name('usuario.eliminar');


//Modificar datos de usuario
Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('usuario.editar');
Route::put('/user/update/{id}', [UserController::class, 'update'])->name('usuario.actualizar');


//Consultar datos de usuario
Route::get('/user/data/{id}', [UserController::class, 'showData'])->name('user.data');


//Listar productos
Route::get('/', [ProductController::class, 'index'])->name('productos.index');
