<?php

    $alumnos = [
        [
            1,
            'juan',
            'perez garcia',
            '2daw',
            'El Bosque'
        ],
        [
            2, 
            'pedro',
            'romero garcia',
            '1daw',
            'Ubrique'
        ],
        [
            3,
            'María',
            'Romero García',
            '1daw',
            'Ubrique'
        ]
    ];

    # Abro el fichero si no existe lo crea.
    $alumnos_csv = fopen("csv/alumnos.csv", "ab");

    foreach($alumnos as $alumno){
        fputcsv($alumnos_csv, $alumno, ";");
    }

    fclose($alumnos_csv);
    echo "Fichero alumnos.csv creado con éxito";
?>