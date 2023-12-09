<?php


    $id_eliminar = $_GET['id'];

    $conexion = new Corredores();

  $corredor = $conexion->delete_Corredor($id_eliminar);



?>