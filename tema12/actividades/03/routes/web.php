<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClientController;
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

// Vinculamos cada ruta con un método del controlador
// Aquí asignamos la ruta nosotros con /clientes, no hay qeu definir clientes en otra parte.
// Route::get('/clientes',[ClientController::class, 'index']);
// Route::get('/clientes/create',[ClientController::class, 'create']);
// Route::get('/clientes/show/{id}',[ClientController::class, 'show']);
// Route::get('/clientes/edit/{id}',[ClientController::class, 'edit']);

// Podemos agrupas las rutas que pertnecen a un mismo controlador
Route::controller(ClientController::class)->group(function(){
    Route::get('/clientes', 'index');
    Route::get('/clientes/create','create');
    Route::get('/clientes/show/{id}','show');
    Route::get('/clientes/edit/{id}', 'edit');
});

// Generamos las rutas AccountController creado con resource
Route::resource('cuentas', AccountController::class);

