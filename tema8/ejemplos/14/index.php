<?php

/*Ejemplo 13. Dircetorios.

*/

echo 'Directorio actual: ' . getcwd();
echo '<br>';
// Cambiar directorio actual.
chdir('files/images');
echo 'Directorio padre: ' . basename(getcwd());
echo '<br>';
mkdir('images/dev');
;

# Eliminar la carpeta dev dentro de images.

// chdir('..');
// rmdir('dev');

# Cambiar nombre carpeta.

chdir('..');
rename('images', 'imagenes');

?>