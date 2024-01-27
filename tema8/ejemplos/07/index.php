<?php

/*Ejemplo 1. Crear archivo texto <plano></plano>*/

# Crear archivo para escritura.
# Si no existe lo crea.

# Apertura

$fichero = "files/ejemplo.txt";


$datos_archivo = stat($fichero);

print_r($datos_archivo);



?>