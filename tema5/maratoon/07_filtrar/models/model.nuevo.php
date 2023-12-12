<?php

    $conexion = new Corredores();

    $clubs = $conexion->get_clubs();
    $categorias = $conexion->get_categorias();
?>