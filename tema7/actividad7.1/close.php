<?php

    //Eliminamos sesión
    //session_destroy();
?>

<?php

    //Inicio de sesión
    session_start();

    //Comprobamos que existe la sesión num_visitas. Si existe se aumenta el nº de visitas. Si no, se crea.
    if (isset($_SESSION['num_visitas_home'])){
        $_SESSION['num_visitas_home']++;
    }else{
        $_SESSION['num_visitas_home'] = 1;

    }
    //Comprobamos que existe la sesión fecha_hora _visitas. Si existe se le asigna la fecha y la hora. Si no, se crea.
    if(isset($_SESSION['fecha_hora_visita'])){
        $_SESSION['fecha_hora_visita'] = date('d-m-Y-H:i:s');
    }else{
        $_SESSION['fecha_hora_visita'] = date('d-m-Y-H:i:s');
    }

     //Comprobamos que existe la sesión fecha_fin_visitas. Si existe se le asigna la fecha y la hora. Si no, se crea.
    if(isset($_SESSION['fecha_fin_sesion'])){

        $fechaCierreSesion = time() + (24 * 60 * 60); //Dentro de 24 horas.

        $_SESSION['fecha_fin_sesion'] = date('d-m-Y-H:i:s', $fechaCierreSesion);
    }else{
        $_SESSION['fecha_fin_sesion'] = date('d-m-Y-H:i:s', $fechaCierreSesion);
    }

    // Pasamos 
    $fecha_conexion = new DateTime($_SESSION['fecha_hora_visita']);
    $fecha_cierre = new DateTime($_SESSION['fecha_fin_sesion']);
    $duracion = date_diff($fecha_cierre, $fecha_conexion);
    
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h3>Detalles de la página</h3>
        <ul>
            <li> SID: <?= session_id()?></li>
            <li> Nombre: <?=session_name()?></li>
            <li> Visitas totales web: <?=$_SESSION['num_visitas_home']?><li>
            <li> Fecha/hora inicio sesión: <?=$_SESSION['fecha_hora_visita']?></li>
            <li> Fecha/hora fin sesión: <?=$_SESSION['fecha_fin_sesion']?></li>
            <li> Duración de la sesión: <?= $duracion->y?> años , <?= $duracion->m?> meses, <?= $duracion->d?> días, <?= $duracion->h?> horas, <?= $duracion->i?> minutos y <?= $duracion->s?> segundos.</li> 
        </ul>
</body>
</html>