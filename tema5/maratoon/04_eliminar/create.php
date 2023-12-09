<?php

    /*Controlador clase create*/  

    //Parámetros de conexión
    include('config/db.php');
    
    //Clases utilizadas en orden
    include('class/class.conexion.php');
    include('class/class.corredor.php');
    include('class/class.corredores.php');
    
    //Models
    include('models/model.create.php');

    //Vista
    header('location: index.php');
?>