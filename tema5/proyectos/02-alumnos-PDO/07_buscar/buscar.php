
<?php

    /*Controlador buscar*/ 

      //Cargamos configuración  
      include('config/db.php');  

      //Cargamos clases a utilizar en orden
      //include('class/class.alumno.php');
      include('class/class.alumnos.php');
      include('class/class.conexion.php');
      include('class/class.curso.php');

      //Cargamos el modelo a utilizar
      include('models/model.buscar.php');

      //Cargamos la vista que se mostrará
      include('views/view/index.php');

?>