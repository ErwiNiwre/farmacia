<?php

use Illuminate\Support\Facades\Route;

// Agregando Controller
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\ClasificacionController;
use App\Http\Controllers\LaboratorioServicioController;
use App\Http\Controllers\CompraController;

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


       // Rutas para LaboratorioServicio
    Route::get('/laboratorioServicios', [LaboratorioServicioController::class, 'index'])->name('laboratorioServicios.index');
    Route::get('/laboratorioServicios/create', [LaboratorioServicioController::class, 'create'])->name('laboratorioServicios.create');
    Route::post('/laboratorioServicios/store', [LaboratorioServicioController::class, 'store'])->name('laboratorioServicios.store');
    Route::get('getListLaboratorioServicio', [LaboratorioServicioController::class, 'getListLaboratorioServicio'])->name('getListLaboratorioServicio');
    Route::get('/laboratorioServicios/{servicio}/edit', [LaboratorioServicioController::class, 'edit'])->name('laboratorioServicios.edit');
    Route::put('/laboratorioServicios/{servicio}', [LaboratorioServicioController::class, 'update'])->name('laboratorioServicios.update');
    Route::get('/laboratorioServicios/{servicio}/destroy', [LaboratorioServicioController::class, 'destroy'])->name('laboratorioServicios.destroy');
    
    
       // Rutas para Compra
    Route::get('/compras', [CompraController::class, 'index'])->name('compras.index');
    Route::get('/compras/create', [CompraController::class, 'create'])->name('compras.create');
    Route::post('/compras/store', [CompraController::class, 'store'])->name('compras.store');
    Route::get('getListCompras', [CompraController::class, 'getListCompras'])->name('getListCompras');
    Route::get('/compras/{compras}/show', [CompraController::class, 'show'])->name('compras.show');
    Route::get('/compras/{compras}/destroy', [CompraController::class, 'destroy'])->name('compras.destroy');
       // Rutas para ProductClasificaciones
    // Route::get('/clasificaciones', [ClasificacionController::class, 'index'])->name('clasificaciones.index');
    // Route::get('/clasificaciones/create', [ClasificacionController::class, 'create'])->name('clasificaciones.create');
    // Route::post('/clasificaciones/store', [ClasificacionController::class, 'store'])->name('clasificaciones.store');

});
