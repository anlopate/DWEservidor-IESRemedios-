<?php

/*Ejemplo 11. Abrir directorio, leer y cerrar directorio.
opendir(), readdir(), closedir()*/

# Mostrar directorio actual. Ruta absoluta.

echo 'Directorio Actual ' . getcwd();
echo '<br>';

if($gestor = opendir('files')){
    echo 'Gestor de directorio: ' . $gestor;
    echo '<br>';

    # Recorro el contenido de la carpeta.
    while ($entrada = readdir($gestor)){

        echo(is_dir($entrada)? 'fichero':'directorio');
        echo ' ';
        echo $entrada;
        echo '<br>';

    }

# Cierro directorio.

closedir($gestor);
echo 'Directorio abierto correctamente';

}else{
    echo 'Error apertura de directorio';
}






?>