<?php

    $conexion = new Corredores();

    // Esta variable se llamará desde "view.index.php" para recorrer los valores obtenidos por la función get_Corredores();
    $corredores=$conexion->get_Corredores();




?>