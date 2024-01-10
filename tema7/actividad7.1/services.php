<?php

    //Inicio de sesión
    session_start();

    //Comprobamos que existe la sesión num_visitas. Si existe se aumenta el nº de visitas. Si no, se crea.
    if (isset($_SESSION['num_visitas_home'])){
        $_SESSION['num_visitas_home']++;
    }else{
        $_SESSION['num_visitas_home'] = 1;

    }
    //Comprobamos que existe la sesión fecha_hora _visitas. Si existe se aumenta el nº de visitas. Si no, se crea.
    if(isset($_SESSION['fecha_hora_visita'])){
        $_SESSION['fecha_hora_visita'] = date('d-m-Y-H:i:s');
        $_SESSION['fecha_hora_visita'] = date('d-m-Y-H:i:s');
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
            <li> Fecha/hora inicio sesión: <?=$_SESSION['fecha_hora_visita']?></li>
            <li> Visitas home: <?=$_SESSION['num_visitas_home']?><li>
        </ul>
</body>
</html>

