<?php

    $expresion = $_GET['expresion'];

    $conexion = new Corredores();

    $corredores = $conexion->filter($expresion);

?>