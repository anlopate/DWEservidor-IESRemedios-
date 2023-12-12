<?php

    /*

        model.filtrar.php

        Método GET:

            - expresion: de búsqueda
        
        Filtra aquel registro que contenga en cualquiera de sus columnas la
        expresión de búsqueda

    */

    // extrigo expresion búsqueda
    $expresion = $_GET['expresion'];

    // Conectando a la base de datos FP
    $conexion = new Alumnos();

    // objeto clase pdostatement con los alumnos filtrados
    $alumnos = $conexion->filter($expresion);
   


?>