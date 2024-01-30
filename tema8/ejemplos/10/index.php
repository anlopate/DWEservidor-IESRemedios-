<?php

/*Ejemplo 10. Contenido de un directorio.*/

# Mostrar directorio actual. Ruta absoluta.

// echo 'Directorio Actual ' . getcwd();

# Obtener contenido del directorio files.

echo '<br>';

$contenido = scandir('files');

print_r($contenido);








?>