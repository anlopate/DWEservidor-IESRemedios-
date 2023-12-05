<?php

$id_eliminar = $_GET['id'];

$conexion = new Alumnos();

$conexion->delete_alumno($id_eliminar);
?>