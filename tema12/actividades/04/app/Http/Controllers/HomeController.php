<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller{

    // Solo un método

    public function __invoke(){
        
        // $autor = 'Ana';
        // $curso = '23/24';
        // $modulo = 'BBDD';
        // $nivel = 2;
        // return view('home.index', compact('autor','curso', 'modulo','nivel'));
        
        $clientes = [
            [
                'id'=> 1,
                'nombre' => 'Pedro'
            ],
            [
                'id'=> 2,
                    'nombre' => 'Paco'
                ],
                [
                    'id'=> 3,
                    'nombre' => 'Ana'
                ],
                [
                    'id'=> 4,
                    'nombre' => 'María'
                    ]
                ];

                $usuarios = [];
                return view('home.index', compact('clientes','usuarios')); 
}
}
?>