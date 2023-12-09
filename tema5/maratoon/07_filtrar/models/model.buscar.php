<?php

    $expresion = $_GET['expresion'];

    $conexion = new Corredores();

    $corredores = $conexion->filtrar_corredores($expresion);

?>