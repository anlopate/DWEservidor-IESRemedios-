<?php
    // Controlador: mostrar.php
    // Descripción: Mostrar un formulario alumno  no editable

     // Cargamos la configuracion  de la base de datos
     include 'config/db.php';
     
     // Cargamos las clases. A tener en cuenta el orden, ya que es importante
     include 'class/class.conexion.php';
     include 'class/class.alumno.php';
     include 'class/class.alumnos.php';
     
     // Cargaremos el modelo
     include 'models/model.mostrar.php';
     
 
     // Cargamos la vista
     include 'views/view.mostrar.php';

?>