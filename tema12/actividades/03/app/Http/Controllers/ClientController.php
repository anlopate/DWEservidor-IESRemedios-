<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    // Mostrar todos los clientes
    public function index(){
        return 'Listar Clientes.';
    }

    public function create() {
        return "Crear Nuevo Usuario";
        }

    public function show($id) {
        return "Mostrando Detalle del usuario: {$id}";
    }

    public function edit($id) {
        return "Editar usuario: {$id}";
        }

           
            
}
