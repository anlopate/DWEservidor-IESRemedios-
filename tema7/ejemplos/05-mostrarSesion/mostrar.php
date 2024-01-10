<?php

/* Ejemplo 7.5
    Variables de sesión */

    # Continuar sesión
    session_start();

    # Mostrar Variable de sesión

    //Una forma
    print_r($_SESSION);
    echo "<br>";
    // Otra forma
    echo 'Id' . $_SESSION['id'];
    echo "<br>";
    echo 'Nombre: ' . $_SESSION['nombre'];
    echo "<br>";
    echo 'Apellidos: ' . $_SESSION['apellidos'];
  


?>