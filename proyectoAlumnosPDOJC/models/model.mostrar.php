<?php

/* 
        Modelo: model.mostrar.php
        Descripción: muestra los detalles de un artículo

        Método GET:
            - id del alumno
*/

# extraemos id alumno
$id = $_GET['id'];

# Creamos una conexion
$conexion = new Alumnos();

# Cargamos los cursos
$cursos = $conexion->getCursos();

# Extraemos objeto con los detalles  del alumno
$alumno = $conexion->read_alumno($id);

# Extraemos nombre del  curso  al  que pertenece el alumno
$curso = $conexion->get_curso($alumno->id_curso);



?>