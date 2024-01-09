
<?php
    /* Contador de visitas */


    //Comprobar si existe la cookie contador

    if(isset($_COOKIE['contador'])){
        //Actualizar el número de visitas
        $num_visitas = $_COOKIE['contador']; //Si existe, asigna a la variable un valor entero (1);
        $num_visitas += 1;
        setcookie('contador', $num_visitas, time() + 365 * 24 * 60 * 60 );
    }else{
        // Creo la cookie con valor 1
        $num_visitas = 1;
        setcookie('contador', $num_visitas, time() + 365 * 24 * 60 * 60 );
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=+, initial-scale=1.0">
    <title>Ejemplo cookie</title>
</head>
<body>
    <h1>Número de visitas: <?=$num_visitas?></h1>
    <ul>
        <li>
            <a href="crear.php">Crear</a>
        </li>
        <li>
            <a href="mostrar.php">Mostrar</a>
        </li>
        <li>
            <a href="eliminar.php">Eliminar</a>
        </li>
    </ul>
</body>
</html>