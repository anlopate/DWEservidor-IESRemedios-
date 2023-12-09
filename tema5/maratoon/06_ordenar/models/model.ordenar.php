<?php

    $criterio_orden= $_GET['criterio'];

    $conexion = new Corredores();

    $corredores= $conexion->ordenar_Corredores($criterio_orden);


?>