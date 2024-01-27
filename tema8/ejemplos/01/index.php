<?php

/*Ejemplo 1. Crear archivo texto <plano></plano>*/

# Crear archivo para escritura.
# Si no existe lo crea.

# Apertura
$fichero = "ejemplo.txt";
$fp = fopen($fichero, 'wb');

# Escritura
fwrite($fp, 'Mi primer fichero texto plano.php');

#Cierre
fclose($fp);

echo('fichero creado con exito');

?>