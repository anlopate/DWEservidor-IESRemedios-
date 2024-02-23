<?php

   $archivo_zip = "files.zip";

   $zip = new ZipArchive();

   if($zip->open($archivo_zip) === true){

    $zip->extractTo('./');
    $zip->close();

    echo 'Archivo descomprimido';
   }else{
    echo 'Error al descomprimir';
   }


?>