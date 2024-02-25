<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller{

    public function __invoke(){
    
        $articulos = [

            [
                'id' => 1,
                'descripcion' => 'Tomate',
                'categoria'=> 'extra',
                'stock' => 50,
                'precio_coste' => 1,
                'precio_venta' => 2

            ],
            [
                'id' => 2,
                'descripcion' => 'Pera',
                'categoria'=> 'conferencia',
                'stock' => 30,
                'precio_coste' => 0.30,
                'precio_venta' => 1.20

            ],
            [
                'id' => 3,
                'descripcion' => 'Calabacín',
                'categoria'=> 'blanco',
                'stock' => 20,
                'precio_coste' => 0.45,
                'precio_venta' => 1.80

            ],
            [
                'id' => 4,
                'descripcion' => 'Sandía',
                'categoria'=> 'rallada',
                'stock' => 25,
                'precio_coste' => 0.50,
                'precio_venta' => 1.50

            ]

    ];
}
}