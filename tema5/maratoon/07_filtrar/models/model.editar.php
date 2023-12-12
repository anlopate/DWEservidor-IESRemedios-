<?php

     
    $id_editar = $_GET['id'];
    $conexion = new Corredores();

    $categorias = $conexion->get_categorias();
    $clubs= $conexion->get_clubs();
    $corredor = $conexion->read($id_editar);
?>