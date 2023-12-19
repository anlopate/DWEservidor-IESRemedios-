<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Hola mundo</h1>
    <h3>Vista Main de Alumnos</h3>

   
    <?php
    
        foreach ($this->alumnos as $alumno):
            var_dump($alumno);
        
    ?>

    <?php 
    
        endforeach;
    ?>
</body>
</html>