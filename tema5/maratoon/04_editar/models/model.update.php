<?php

    $id_editar = $_GET['id'];

    $nombre       =$_POST['nombre'];
    $apellidos    =$_POST['apellidos'];
    $ciudad       =$_POST['ciudad'];
    $fecha        =$_POST['fecha'];
    $sexo         =$_POST['genero'];
    $email        =$_POST['email'];
    $dni          =$_POST['dni'];
   // $edad         =$_POST['edad'];
    $categoria    =$_POST['categoria'];
    $club         =$_POST['club'];
    
    $corredor = new Corredor();

    $corredor->id              = $id_editar;
    $corredor->nombre          = $nombre;
    $corredor->apellidos       = $apellidos;
    $corredor->ciudad          = $ciudad;
    $corredor->fechaNacimiento = $fecha;
    $corredor->sexo            = $sexo;
    $corredor->email           = $email;
    $corredor->dni             = $dni;
   // $corredors->edad           = $edad;
    $corredor->id_categoria    = $categoria;
    $corredor->id_club         = $club;

    $conexion = new Corredores();

    $conexion->delete($corredor, $id_editar);




?>