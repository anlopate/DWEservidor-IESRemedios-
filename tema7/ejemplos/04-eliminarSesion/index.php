<?php

    /*Ejemplo 7.4 Crear sesión*/


    # Inicio sesión
    session_start();
    echo "Sesión iniciada.";
    echo "<br>";
    echo "SID " . session_id();
    echo "<br>";
    echo "Name " . session_name();





?>