<?php

    //Capturamos por GET el id del corredor a editar

    $id_editar = $_GET['id'];

    //Conectamos con la bbdd a través de la claseCorredores

    $conexion = new Corredores();

    //Recogemos las categorias disponibles
    $categorias = $conexion->get_Categorias();

    //Recogemos los clubs disponibles
    $clubs = $conexion->get_Clubs();

    //Buscamos el corredor a editar
    $corredor = $conexion->read_Corredor($id_editar);

    
?>