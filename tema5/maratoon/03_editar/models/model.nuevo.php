<?php

$conexion = new Corredores();

 /*Capturamos los datos de los clubs*/ 
 $clubs = $conexion->get_Clubs();

 /*Recogemos los datos de las categorias*/  

 $categorias = $conexion->get_Categorias();

?>