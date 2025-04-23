<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/dashboard', function () {
    return view('auth.dashboard');
})->middleware('auth');


//Prueba borrado de usuario
Route::delete('/user/delete/{id}', [UserController::class, 'delete'])->name('usuario.eliminar');
