<?php

    /*

        Modelo Principal index

    */

    # Ejecuto el constructro de la clase conexión
    //Conectando a la base de datos FP
    $conexion = new Alumnos();//es hija de la clase conexión y ejecuta el constructor de la conexión

    #Extraigo los valores de los alumnos
    //$alumnos es un objeto de la clase pdostatement
    $alumnos = $conexion->getAlumnos();

   
?>