<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index(){
        return "Listado de movimientos";
    }

    public function create(){
        return "Movimiento creado";
    }

    public function update ($id){
        return "Movimiento editado";
    }

    public function show ($id){
        return "Mostrar movimiento";
    }

    public function delete ($id){
        return "Borrar movimiento";
    }
}
