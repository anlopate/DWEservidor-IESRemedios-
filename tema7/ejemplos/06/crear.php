<?php

    /* crear.php 
    Ejemplo creación cookie*/ 


    //Nombre cookie
    $nombre_cookie = 'datos_personales';
    //Almacene el nombre
    $nombre = 'Ana';
    //Expire a los 60 minutos
    $expiracion = time() + 60 * 60;
    
    
    if (setcookie($nombre_cookie, $nombre,  $expiracion)){//Hay que respetar el orden de los parámetros.
        echo 'Cookie creada correctamente.';
    } 
    
    echo '<br>';
    $apellidos = 'Lopez_Atero';
    $nombre_cookie2 = 'mis_datos';
    if(setcookie($nombre_cookie2, $apellidos, $expiracion)){
        echo 'Segunda cookie creada correctamente.';
    }else{
        echo 'Cookie no creada.';
    }



?>