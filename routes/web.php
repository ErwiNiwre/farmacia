<?php

use Illuminate\Support\Facades\Route;

// Agregando Controller
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\RolController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/vis', function () {
//     return view('app.app');
// });

// Route::get('/', function () {
//     return view('auth.login');
// });

// Route::get('/login', [HomeController::class, 'index'])->name('login');

Route::middleware('auth', 'verified')->group(function () {
    // Pagina Inicial
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Rutas para Roles
    Route::get('/roles', [RolController::class, 'index'])->name('roles.index');
    Route::get('/roles/create', [RolController::class, 'create'])->name('roles.create');
    Route::post('/roles/store', [RolController::class, 'store'])->name('roles.store');
    Route::get('/roles/{rol}/show', [RolController::class, 'show'])->name('roles.show');
    Route::get('/roles/{rol}/edit', [RolController::class, 'edit'])->name('roles.edit');
    Route::put('/roles/{rol}', [RolController::class, 'update'])->name('roles.update');

    // Rutas para Productos
    Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
    Route::get('/productos/create', [ProductoController::class, 'create'])->name('productos.create');
    Route::post('/productos/store', [ProductoController::class, 'store'])->name('productos.store');
    Route::get('/productos/{producto}/show', [ProductoController::class, 'show'])->name('productos.show');
    Route::get('/productos/{producto}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
    Route::put('/productos/{producto}', [ProductoController::class, 'update'])->name('productos.update');
});
