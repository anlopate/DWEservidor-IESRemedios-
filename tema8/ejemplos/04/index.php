<?php

/*Ejemplo 1. Crear archivo texto <plano></plano>*/

# Crear archivo para escritura.
# Si no existe lo crea.

# Apertura
$fichero = "files/ejemplo.txt";
$cadena = file_get_contents($fichero);


$cadena = $cadena . "\n". "Introduce línea";

file_put_contents($fichero, $cadena);

// $fp = fopen($fichero, 'ab');

// # Escritura
// fwrite($fp, "\n");
// fwrite($fp, 'Esta nueva línea.');


#Cierre
fclose($fp);

echo('fichero creado con exito');

?>