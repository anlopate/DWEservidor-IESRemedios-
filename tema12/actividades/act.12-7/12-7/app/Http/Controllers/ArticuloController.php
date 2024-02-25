<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articulos = [
        
            [
                'id' => 1,
                'descripcion'=>'Portátil HP MD12345',
                'categoria'=> 0,
                'stock'=> 12,
                'precio_coste'=> 550.50,
                'precio_venta'=> 1550.50
            ],
            [
                'id' => 2,
                'descripcion'=>'Tablet - Samsung Galaxy Tab A (2019)',
                'categoria'=> 5,
                'stock'=> 200,
                'precio_coste'=>300,
                'precio_venta'=> 1300
            ],
            [
                'id' => 3,
                'descripcion'=>'Impresora multifunción - HP',
                'categoria'=> 4,
                'stock'=> 2000,
                'precio_coste'=>69,
                'precio_venta'=> 169
            ],
            [
                'id' => 4,
                'descripcion'=>'TV LED 40" - Thomson 40FE5606 - Full HD',
                'categoria'=> 3,
                'stock'=> 300,
                'precio_coste'=> 259,
                'precio_venta'=>1259
            ]
           
    
        ];

        return view('articulos', compact('articulos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
