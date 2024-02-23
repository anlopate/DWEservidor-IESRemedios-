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

Route::get('/test', function () {
    return "Ana, DWEservidor, 2ºDAW, Prueba";
});

Route::get('/api/user', function () {
    return "La informática es una disciplina que promueve la creatividad y la resolución de problemas, donde los límites son solo nuestra imaginación y nuestra capacidad para innovar.";
});

Route::get('/user/{nombre}/{apellidos}', function ($nombre, $apellidos) {
    return "{$nombre} {$apellidos}";
});

Route::get('/user/view/{id?}', function ($id) {
    return "View: {$id}";
});

Route::get('/user/edad/{nombre}/{edad?}', function ($nombre, $edad) {
    return "{$nombre} tiene {$edad} años";
});


