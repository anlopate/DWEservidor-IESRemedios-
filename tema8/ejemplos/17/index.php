<?php

    /* Ejemplo 17
        Añadir todos los archivos de una carpeta
    */

    // Creamos objeto de la clase zipArchive
    $zip = new zipArchive();

    // abrir archivo zip. Utilizo el método open da la clase zip archivo.
    // true en este caso es 1.
    if ($zip->open('files.zip', ZipArchive::CREATE) === true){

        $files = glob('files/*');
        
        foreach($files as $file){
            $zip->addFile($file);
        }
        // Proceso finalizado
        $zip->close();
        echo "Carpeta comprimida correctamente";
    }else{
         echo 'error';   

    }


?>