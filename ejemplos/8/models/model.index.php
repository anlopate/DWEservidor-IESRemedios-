<?php

    /* Model principal index  */

    #Insertar registro en la tabla cursos de la bbdd fp

    #Creamos objetos de la clase Curso
    $curso = new Curso();

    $curso->nombre= "Primero Desarrollo Aplicaciones Multiplataforma";
    $curso->ciclo= "Desarrollo Aplicaciones Multiplataforma";
    $curso->nombreCorto= "1DAM";
    $curso->nivel = "1"; 

    #Conectamos con la bbdd

    $fp = new Fp();
    $fp->insert_curso($curso);

    echo "curso añadido correctamente";

?>