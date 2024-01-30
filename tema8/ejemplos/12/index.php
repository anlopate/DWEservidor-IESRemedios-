<?php

/*Ejemplo 12. Permite especificar un patrón.

glob()*/

// Abrir el directorio files.Con *.* devuelve solo los archivos.

$archivos = glob('files/*.*');

print_r($archivos);
echo '<br>';
// Así devuelve los directorios y los archivos

$archivos = glob('files/*');

print_r($archivos);
echo '<br>';

// Los archivos txt

$archivos = glob('files/*.txt');

print_r($archivos);
echo '<br>';





?>