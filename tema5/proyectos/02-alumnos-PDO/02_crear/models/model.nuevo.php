<?php

    /*

        Modelo model.nuevo.php

    */

    # Ejecuto el constructro de la clase conexión
    //Conectando a la base de datos FP
    $conexion = new Alumnos();

    #Extraigo los valores de los alumnos
    //$alumnos es un objeto de la clase pdostatement
    $cursos = $conexion->getCursos();

   
?>