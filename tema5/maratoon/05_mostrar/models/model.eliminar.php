<?php

    $id_borrar = $_GET['id'];

    $conexion = new Corredores();

    $conexion->delete($id_borrar);


?>