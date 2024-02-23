<?php

    // Cabecera obligatoria aunque en los apuntes diga opcional
    $header .= "Mime-Versión: 1.0". "\r\n";
    $header .= "Content-Type: text/html; charset-UTF-8"."\r\n";
    $header .= "From: Ana López<ana.atero@hotmail.com>\n";
    $header .= "Cc: analopezatero@gmail.com";
    $header .= "Cco: sita.marvin18@gmail.com";
    $header .= "X-Mailer: PHP/" . phpversion();

    // PArámetros
    $destino = "ana.atero@hotmail.com";
    $asunto = "Mensaje prueba mail()";
    $mensaje = "<h1>Lorem Ipsum es simplemente el texto de</h1>
    <p>relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas , las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.</p>";

    // Envío
    if(mail($destino, $asunto, $mensaje, $header)){
        echo 'Mensaje enviado correctamente';
    }else{
        echo "Error. Mensaje no ha podido ser enviado.";
    }

?>