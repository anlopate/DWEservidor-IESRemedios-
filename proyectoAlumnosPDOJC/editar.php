<?php
    // Controlador: editar.php
    // Descripción: Mostrar un formulario con los detalles editables del alumno seleccionado

     // Cargamos la configuracion  de la base de datos
     include 'config/db.php';
     
     // Cargamos las clases. A tener en cuenta el orden, ya que es importante
     include 'class/class.conexion.php';
     include 'class/class.alumnos.php';
     
     // Cargaremos el modelo
     include 'models/model.editar.php';
     
 
     // Cargamos la vista
     include 'views/view.editar.php';
 ?>
?>