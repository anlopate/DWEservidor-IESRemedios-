<?php

/*Ejemplo 1. Crear archivo texto <plano></plano>*/

# Crear archivo para escritura.
# Si no existe lo crea.

# Apertura

$fichero = "files/ejemplo.txt";


if(is_file($fichero)){
     echo 'Es un fichero.';
     echo '<br>';
     echo 'Tamaña fichero: '.filesize($fichero). ' Bytes.';
     echo '<br>';
     echo 'Fecha: ' . filemtime($fichero);
     echo '<br>';
     echo 'Tipo: ' . filetype($fichero);
}

echo '<br>';

if(is_dir('files')){
    echo 'Files es una carpeta.';
}



?>