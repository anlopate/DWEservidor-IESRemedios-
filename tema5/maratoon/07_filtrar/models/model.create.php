<?php

   /*Recogemos en variables los valores del formulario*/  

   $nombre =          $_POST['nombre'];
   $apellidos =       $_POST['apellidos'];
   $ciudad =          $_POST['ciudad'];
   $sexo =          $_POST['genero'];
   $fechaNacimiento = $_POST['fecha'];
   $email=            $_POST['email'];
   $dni=              $_POST['dni'];
   $categoria=        $_POST['id_categoria'];
   $club=             $_POST['id_club'];

   /*Creamos un objeto de la clase Corredor*/ 

   $corredor = new Corredor();

   /*Asignamos los valores recogidos del formulario al nuevo objeto corredor*/  

   $corredor->nombre = $nombre;
   $corredor->apellidos = $apellidos;
   $corredor->ciudad = $ciudad;
   $corredor->fechaNacimiento = $fechaNacimiento;
   $corredor->sexo = $sexo;
   $corredor->email = $email;
   $corredor->dni = $dni;
   $corredor->id_categoria = $categoria;
   $corredor->id_club = $club;

    /*Insertamos los datos del nuevo corredor a la bbdd*/  

    $conexion=new Corredores();
    $conexion->insert_Corredor($corredor);

   

    

?>