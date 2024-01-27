<?php

/*Ejemplo 1. Crear archivo texto <plano></plano>*/

# Crear archivo para escritura.
# Si no existe lo crea.

# Apertura

$fichero = "files/ejemplo.txt";
$fp = fopen($fichero, 'rb');


# Recorre archivo.
while(!feof($fp)){

    $linea = fgets($fp);

    echo $linea;
    echo "\n";

}


?>