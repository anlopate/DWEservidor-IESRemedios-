<?php

    /*
        ordenar.php
        Controlador ordenar tabla de alumnos
    */

    # Cargamos configuración
    include('config/db.php');

    # Cargamos clases en orden
    include('class/class.conexion.php');
    include('class/class.alumnos.php');

    # Cargo modelo
    include('models/model.ordenar.php');

    # Cargo vista
    include('views/view.index.php');

?>