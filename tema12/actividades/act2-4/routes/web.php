<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\AccountController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/clientes',[ClientController::class, 'index']);
// Route::get('/clientes/create',[ClientController::class, 'create']);
// Route::get('/clientes/update/{id}',[ClientController::class, 'update']);
// Route::get('/clientes/show/{id}',[ClientController::class, 'show']);
// Route::get('/clientes/delete/{id}',[ClientController::class, 'delete']);

// // Rutas de producto creadas con resource
// Route::resource('/producto', ProductoController::class);
// Route::resource('/producto/create', ProductoController::class);
// Route::resource('/producto/update/{id}', ProductoController::class);
// Route::resource('/producto/show/{id}', ProductoController::class);
// Route::resource('/producto/delete/{id}', ProductoController::class);

// Rutas de movimientos con nombre de ruta asignada
Route::get('/account', [AccountController::class, 'index']) -> name('account.index');
Route::get('/account/create', [AccountController::class, 'create']) -> name('account.create');
Route::get('/account/update/{id}', [AccountController::class, 'update']) -> name('account.update');
Route::get('/account/show/{id}', [AccountController::class, 'show']) -> name('account.show');
Route::get('/account/delete/{id}', [AccountController::class,'delete']) -> name('account.delete');
