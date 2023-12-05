
<?php
    $criterioOrden = $_GET['criterio'];

    $conexion = new Alumno();

    $conexion->ordenar($criterioOrden);
?>