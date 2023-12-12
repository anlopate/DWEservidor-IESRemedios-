<?php
    /*
        Controlador: update.php
        Descripción: actualizar los datos de un alumno
    */

    // Cargamos la configuracion
    include 'config/db.php';

    // Cargamos las clases
    include 'class/class.conexion.php';
    include 'class/class.alumno.php';
    include 'class/class.alumnos.php';
    
    // Cargaremos el modelo
    include 'models/model.update.php';
    
    // Redireccionamos al controlador index
    header('location: index.php');
?>