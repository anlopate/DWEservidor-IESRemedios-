<?php

   /*  
        model.ordenar.php

    */
$criterio = $_GET['criterio'];

$conexion = new Libros();

$libros=$conexion->order($criterio);

?>