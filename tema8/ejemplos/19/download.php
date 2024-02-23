<?php

/* Descragar archivo. */
/* Los header son instrucciones que el php envía al html para que éste lo envíe al navegador*/

$file = 'files.zip';

if (file_exists($file)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($file));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        ob_clean();
        flush();
        readfile($file);
        echo 'El archivo se ha descargado correctamente';
 exit;
} else {
 echo 'El archivo no existe.';
}


?> 