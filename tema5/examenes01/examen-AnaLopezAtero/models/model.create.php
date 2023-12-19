<?php

    /*
        Modelo create

        Recibe los valores del formulario nuevo libro
        hay que tener en cuenta que he dejado de utilizar algunos campos
    */

    
    $titulo          =$_POST['titulo'];
    $isbn            =$_POST['isbn'];
    $fechaEdicion    =$_POST['fecha_edicion'];
    $autor           =$_POST['autor'];
    $editorial       =$_POST['editorial'];
    $stock           =$_POST['stock'];
    $precio_coste    =$_POST['precio_coste'];
    $precio_venta    =$_POST['precio_venta'];

    $libro = new libro();

    $libro->titulo       = $titulo;
    $libro->isbn         = $isbn;
    $libro->fechaEdicion = $fechaEdicion;
    $libro->autor_id        = $autor;
    $libro->editorial_id    = $editorial;
    $libro->stock        = $stock;
    $libro->precio_coste = $precio_coste;
    $libro->precio_venta = $precio_venta;

    /*var_dump($libro);
    exit();*/

    $libros = new libros();

    $libros->crear($libro);
   
?>