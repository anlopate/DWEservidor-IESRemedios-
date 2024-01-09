<?php

    /*Ejemplo 7.1 Sesión personalizada*/


    # Personalizar sesión
        //Personalizar el SID
        session_id('10110101010123');
        //Personalizar el nombre de la sesión
        session_name('GESBANK_ini');
        //Puedo tener dos sesiones con mismo nombre y diferente SID o al revés, pero no con mismo nombre y mismo SID.

    # Inicio sesión
    session_start();
    echo "Sesión iniciada.";
    echo "<br>";
    echo "SID " . session_id();
    echo "<br>";
    echo "Name " . session_name();





?>