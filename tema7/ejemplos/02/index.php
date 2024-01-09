<?php

    /*Ejemplo 7.1 Inicio de sesión*/


    # Iniciamos sesión
    session_start();
    echo "Sesión iniciada.";
    echo "<br>";
    echo "SID " . session_id();
    echo "<br>";
    echo "Name " . session_name();





?>