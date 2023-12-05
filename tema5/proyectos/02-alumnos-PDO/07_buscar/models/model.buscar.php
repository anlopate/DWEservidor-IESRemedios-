<?php


    $expresion = $_GET['expresion'];

    $conexion = new Alumnos();

    $alumnos = $conexion->filter($expresion);

?>