<?php

    $criterio = $_GET['criterio'];

    $conexion = new Corredores();

    $corredores =$conexion->ordenar($criterio);
?>