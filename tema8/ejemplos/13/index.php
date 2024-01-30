<?php

/*Ejemplo 13. Dircetorios.

*/

echo 'Directorio actual: ' . getcwd();
echo '<br>';
echo 'Directorio padre: ' . dirname(getcwd());
echo '<br>';
print_r(pathinfo(getcwd()));
echo '<br>';
$detalles = pathinfo(getcwd());
echo 'Directorio actual: ' . $detalles['basename'];
echo '<br>';
// otra forma
echo 'Directorio actual: ' . basename(getcwd());







?>