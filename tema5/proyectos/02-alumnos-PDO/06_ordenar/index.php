<?php

    /*
        Controlador principal index con PDO
        Muestra los detalles de los alumnos
    */

    # Cargamos configuración
    include('config/db.php');

    # Cargamos librería de funciones

    # Cargamos clases en orden
    include('class/class.conexion.php');
    //include('class/class.alumno.php'); En el index no hace falta
    include('class/class.alumnos.php');

    # Cargo modelo
    include('models/model.index.php');

    # Cargo vista
    include('views/view.index.php');
?>