<?php

    /*

        Modelo: model.create.php
        Descripcion: añade un nuevo  alumno a la tabla alumnos de la bbdd fp

        Método POST:
                    - id 
                    - nombre
                    - apellidos
                    - email
                    - telefono
                    - direccion
                    - poblacion
                    - provincia
                    - nacionalidad
                    - dni
                    - fechaNac
                    - id_curso

    */
    //Capturamos el id del alumno a través del método GET

    $id_actualizar = $_GET['indice'];
   
    # Cargamos en varibales detalles del  formulario
    $id             = $_GET['indice'];
    $nombre         = $_POST['nombre'];
    $apellidos      = $_POST['apellidos'];
    $email          = $_POST['email'];
    $telefono       = $_POST['telefono'];
    $direccion      = $_POST['direccion'];
    $poblacion      = $_POST['poblacion'];
    $provincia      = $_POST['provincia'];
    $nacionalidad   = $_POST['nacionalidad'];
    $dni            = $_POST['dni'];
    $fechaNac       = $_POST['fechaNac'];
    $id_curso       = $_POST['id_curso'];

    # Creamos un  objeto de la clase Alumno
    $alumno = new Alumno();

    # Asignamos valores a las propiedades
    $alumno->id = $id;
    $alumno->nombre = $nombre;
    $alumno->apellidos = $apellidos;
    $alumno->email = $email;
    $alumno->telefono = $telefono;
    $alumno->direccion = $direccion;
    $alumno->poblacion = $poblacion;
    $alumno->provincia = $provincia;
    $alumno->nacionalidad = $nacionalidad;
    $alumno->dni = $dni;
    $alumno->fechaNac = $fechaNac;
    $alumno->id_curso = $id_curso;

    # Validación

    # Insertar registro
    $conexion = new Alumnos();
    $conexion->update_alumno($alumno,$id_actualizar);

    //$alumnos = $conexion->getAlumnos();
    

    
?>