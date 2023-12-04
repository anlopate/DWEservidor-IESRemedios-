<?php

    /*
        Controlador principal create con PDO
    */

    # Cargamos configuración
    include('config/db.php');

    # Cargamos librería de funciones

    # Cargamos clases en orden
    include('class/class.conexion.php');
    include('class/class.alumno.php');//Sí hace falta la clase alumno
    include('class/class.alumnos.php');

    # Cargo modelo
    include('models/model.create.php');

    # Redireccionar al controlador principal
    header('location: index.php');//nos lleva de nuevo al index para ver el alumno cargado
?>