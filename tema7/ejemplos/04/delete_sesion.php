<?php

     /*Ejemplo 7.4 Destruir sesión*/

     # Continúo con la sesión
     session_start();

     # Detalles de sesión

     echo "SID " . session_id();
     echo "<br>";
     echo "Name " . session_name();

     # Elimino sesión pero mantiene la cookie
     session_destroy();
    
     #Elimina todas las variables de sesión
     session_unset();


?>