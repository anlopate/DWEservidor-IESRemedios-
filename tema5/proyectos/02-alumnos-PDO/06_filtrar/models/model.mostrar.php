<?php
    /* 
        Modelo: modelMostrar.php
        Descripción: muestra los detalles de un artículo

        Método GET:
            - id del artículo que quiero mostrar
    */

    $id = $_GET['id'];
    
    // Cargamos los cursos
    $cursos = $conexion->getCursos();
    
    // Cargamos los datos del alumno según su id
    $alumno = $conexion->readAlumno($id);
    
    // Creamos una conexion
    $conexion = new Alumnos();

    

?>