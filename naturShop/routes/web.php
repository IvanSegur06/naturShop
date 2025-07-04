<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoryController;



Route::get('/dashboard', [AddressController::class, 'index'])->middleware('auth')->name('dashboard');



//Prueba borrado de usuario
Route::delete('/user/delete/{id}', [UserController::class, 'delete'])->name('usuario.eliminar');


//Modificar datos de usuario
Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('usuario.editar');
Route::put('/user/update/{id}', [UserController::class, 'update'])->name('usuario.actualizar');


//Consultar datos de usuario
Route::get('/user/data/{id}', [UserController::class, 'showData'])->name('user.data');


//Listar productos
Route::get('/', [ProductController::class, 'index'])->name('productos.index');
Route::get('/', [ProductController::class, 'shop'])->name('shop');



Route::resource('address', AddressController::class)->middleware('auth');


Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
//Eliminar producto
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

Route::prefix('cart')->middleware('auth')->group(function() {
    Route::get('/', [ShoppingCartController::class, 'index'])->name('cart.index');
    Route::post('/add/{productId}', [ShoppingCartController::class, 'addProductToCart'])->name('cart.add');
    Route::delete('/remove/{productId}', [ShoppingCartController::class, 'removeProduct'])->name('cart.remove');
    Route::post('/decrease/{productId}', [ShoppingCartController::class, 'decreaseProductQuantity'])->name('cart.decrease');
    Route::post('/checkout', [OrderController::class, 'createOrder'])->name('checkout');
});


Route::post('/favoritos/{product}', [\App\Http\Controllers\FavoriteController::class, 'toggle'])->name('favorites.toggle')->middleware('auth');




Route::post('/products/{product}/assign-category', [CategoryController::class, 'assign'])->name('products.assignCategory');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

Route::post('/cart/apply-discount', [ShoppingCartController::class, 'applyDiscount'])->name('cart.applyDiscount');
