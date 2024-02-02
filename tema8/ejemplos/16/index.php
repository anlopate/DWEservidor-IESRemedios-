<?php

    /* Para usar zipArchive es necesario quitar ; en el archivo php init, en extenison=zip*/

    // Creamos objeto de la clase zipArchive
    $zip = new zipArchive();

    // abrir archivo zip. Utilizo el método open da la clase zip archivo.
    // true en este caso es 1.
    if ($zip->open('files.zip', ZipArchive::CREATE) === true){

        $zip->addFile('files/Interestelar 2023.pdf');
        $zip->addFile('files/mafalda_rosa.jpg');

        // Proceso finalizado
        $zip->close();
        echo "Archivo comprimido correctamente";
    }else{
         echo 'error';   

    }


?>