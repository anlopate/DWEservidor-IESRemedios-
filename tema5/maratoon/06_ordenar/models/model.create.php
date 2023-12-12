<?php

   

    //Cogemos los datos del formulario de nuevo corredor

   
    $nombre =           $_POST['nombre'];
    $apellidos =        $_POST['apellidos'];
    $ciudad =           $_POST['ciudad'];
    $fecha=             $_POST['fecha'];
    $sexo=              $_POST['genero'];
    $email=             $_POST['email'];
    $dni=               $_POST['dni'];
    $edad=              $_POST['edad'];
    $categoria=         $_POST['categoria'];
    $club =             $_POST['club'];
    
    $corredor = new Corredor();

  
    $corredor->nombre = $nombre;
    $corredor->apellidos = $apellidos;
    $corredor->ciudad = $ciudad;
    $corredor->fechaNacimiento = $fecha;
    $corredor->sexo = $sexo;
    $corredor->email = $email;
    $corredor->dni = $dni;
    $corredor->edad = $edad;
    $corredor->id_categoria = $categoria;
    $corredor->id_club = $club;

    $conexion = new Corredores();

    $conexion->insert_corredor($corredor);
?>