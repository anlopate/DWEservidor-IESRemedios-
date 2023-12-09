<?php

    $id_mostrar = $_GET['id'];

    $conexion = new Corredores();

    $clubs = $conexion->get_Clubs();
    $categorias = $conexion->get_Categorias();

    $corredor= $conexion->read_Corredor($id_mostrar);

?>