<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductoController extends Controller
{
   
    public function index()
    {
        return 'Listar Productos.';
    }

        public function create()
    {
        return "Crear Nuevo Producto";
    }

    public function update($id)
    {
        return "Producto {$id} editado correctamente. ";
    }

    
    public function show($id)
    {
       return "Mostrando Detalle del producto: {$id}";
    }

   
    public function delete($id)
    {
    return "Usuario {$id} borrado correctamente"; 
    }

   
}
