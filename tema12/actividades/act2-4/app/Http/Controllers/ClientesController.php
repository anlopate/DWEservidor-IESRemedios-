<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientesController extends Controller
{
     
     public function index(){
        return 'Listar Clientes.';
    }

    public function create() {
        return "Crear Nuevo Usuario";
        }

    public function update($id) {
        return "Editar usuario: {$id}";
        }

    public function delete($id) {
        return "Usuario {$id} borrado correctamente";
        }
        
    public function show($id) {
        return "Mostrando Detalle del usuario: {$id}";
    }


}
