<?php

    /*

        model.ordenar.php

        Método GET:

            - criterio: de ordenación

    */

    // extrigo el criterio de ordenación URL
    $criterio = $_GET['criterio'];

    // Conectando a la base de datos FP
    $conexion = new Alumnos();

    // objeto clase pdostatement ordenados por criterio
    $alumnos = $conexion->order($criterio);
   


?>