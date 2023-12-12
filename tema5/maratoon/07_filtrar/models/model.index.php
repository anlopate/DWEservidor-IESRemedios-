<?php

    /*conectamos con la bbbd para mostrar todos los corredores a través del método get de la clase <corredores></corredores>*/ 

    $conexion = new Corredores();
    $corredores = $conexion->get_corredores();
  
?>