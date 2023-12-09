<?php

    //Cargamos los parámetro de la onexión a la bbdd
    include('config/db.php');

    //Cargamos las clases a utilizar en orden    
    include('class/class.conexion.php');
    include('class/class.corredor.php');
    include('class/class.corredores.php');

    //Cargamos el modelo
    include('models/model.editar.php');

    //Cargamos la vista
    include('views/view.editar.php');

?>