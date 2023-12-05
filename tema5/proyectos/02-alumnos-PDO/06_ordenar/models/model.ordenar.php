
<?php
    $criterioOrden = $_GET['criterio'];

    $conexion = new Alumnos();

    $alumnos = $conexion->ordenar($criterioOrden);
?>