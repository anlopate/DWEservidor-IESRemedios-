<?php

/* Ejemplo 7.5
    Variables de sesión */

    # Continuar sesión
    session_start();

    # Crear Variable de sesión

    $_SESSION['nombre'] = 'Ana';
    $_SESSION['apellidos'] = 'Lopez Atero';
    $_SESSION['id'] = 234;

    echo "Variable creadas correctamente";

?>