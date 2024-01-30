<?php

/*Ejemplo 8. Copiar, mover, cambiar nombre, eliminar*/

# Copiar archivo
// Una nueva versión.

// copy('ejemplo.txt', 'datos.txt');

// echo 'Archivo copiado correctamente';

# Copiar archivo en otra carpeta.
// copy('ejemplo.txt', 'files/datos.txt');
// echo 'Archivo copiado correctamente';

# Machacar al copiar.
// copy('datos.txt', 'files/datos.txt');
// echo 'Archivo copiado correctamente';

# Cambiar nombre.
// rename('datos.txt', 'detalles.txt');
// echo 'Archivo renombrado correctamente';

// # Mover archivo. También se utiliza rename.
// rename('detalles.txt', 'files/detalles.txt');

# Eliminar archivo.
unlink('ejemplo.txt');
echo 'Archivo eliminado.';




?>