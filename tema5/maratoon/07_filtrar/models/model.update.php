<?php

    //Capturamos el índice de 
    $id_actualizar = $_GET['id'];

    
    //Capturamos datos del formulario 
    
    $id           =$_GET['id'];
    $nombre       =$_POST['nombre'];
    $apellidos    =$_POST['apellidos'];
    $ciudad       =$_POST['ciudad'];
    $fechaNac     =$_POST['fecha'];
    $sexo         =$_POST['genero'];
    $email        =$_POST['email'];
    $dni          =$_POST['dni'];
    //$edad         =$_POST['edad'];
    $id_categoria =$_POST['id_categoria'];
    $id_club      =$_POST['id_club'];
    
    //Creamos un uevo objeto corredor
    $corredor = new Corredor();

    //Asignamos los datos al nuevo corredor

    $corredor->id=$id;
    $corredor->nombre = $nombre;
    $corredor->apellidos = $apellidos;
    $corredor->ciudad = $ciudad;
    $corredor->fechaNacimiento = $fechaNac;
    $corredor->sexo = $sexo;
    $corredor->email = $email;
    $corredor->dni = $dni;
    $corredor->id_categoria = $id_categoria;
    $corredor->id_club = $id_club;

    //Conectamos con la bbdd
    $conexion = new Corredores();

    //Actualizamos el corredor

    $conexion->update_Corredor($corredor, $id_actualizar);
?>