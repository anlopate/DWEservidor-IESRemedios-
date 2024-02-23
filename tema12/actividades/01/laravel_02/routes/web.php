<?php

use Illuminate\Support\Facades\Route;

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

// creaamos una nueva ruta para la web
Route::get('/client', function () {
    return ('Clientes');
});

Route::get('/client/new', function () {
    return "Vista Nuevo Cliente";
});

// Vamos al metodo delete cliente
Route::get('/client/delete', function () {
    return ('Metodo delete de clientes');
});

// Creamos ruta con parametro de esta forma:
    Route::get('/client/edit/{id}', function ($id) {
        return ("Editado Cliente: {$id}"); // con dobles comillas y entre llaves
    });

// Creamos ruta con parametro de esta forma:
    Route::get('/client/show/{id}', function ($id) {
        return ("Muestra Cliente: {$id}"); // con dobles comillas y entre llaves
    });

// Creamos ruta con parametro de esta forma:
Route::get('/client/delete/{id}', function ($id) {
    return ("Eliminando Cliente: {$id}"); // con dobles comillas y entre llaves
});

// Parametros obligatorios
Route::get('/client/delete/{id1}/{id2}', function ($id1, $id2) {
    return ("Eliminando Cliente: {$id1} y {$id2}"); // con dobles comillas y entre llaves
});

// Parametros opcionales OJO a la ? en la definicion
Route::get('/client/delete/{id1?}/{id2?}', function ($id1 = null, $id2 = null) {
    return ("Eliminando Cliente: {$id1} y {$id2}"); // con dobles comillas y entre llaves
});