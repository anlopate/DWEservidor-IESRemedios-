<?php

    /* mostrar.php 
   Mostrar el valor de una cookie*/ 


    //Acceder a la cookie
    
    if (isset($_COOKIE['datos_personales'])){
        echo $_COOKIE['datos_personales'];
        echo '<br>';

    }else{
        echo 'Cookie no existe.';

    }

    print_r($_COOKIE);

?>