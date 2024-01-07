<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once("template/partials/head.php") ?>
</head>

<body>
        <?php require_once("template/partials/menu.php") ?>
        <br><br><br>
        <div class="container">
        <br><br>
        <?php include 'template/partials/head.php' ?>

        <legend>Formulario Nuevo cliente</legend>
       
        <form action="<?=URL?>cliente/create" method="POST">
         
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre">
            </div>
           
            <div class="mb-3">
                <label class="form-label">Apellidos</label>
                <input type="text" class="form-control" name="apellidos">
            </div>
            
            <div class="mb-3">
                <label class="form-label">Correo Electronico</label>
                <input type="email" class="form-control" name="email">
            </div>
           
            <div class="mb-3">
                <label class="form-label">Télefono</label>
                <input type="number" class="form-control" name="telefono">
            </div>
            
            <div class="mb-3">
                <label class="form-label">Ciudad</label>
                <input type="text" class="form-control" name="ciudad">
            </div>
           
            <div class="mb-3">
                <label class="form-label">DNI</label>
                <input type="text" class="form-control" name="dni" pattern="[0-9]{8}[A-Z]{1}">
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Añadir</button>
            </div>

        </form>
        <br>
        <br>
        <br>
       
        <?php require_once("template/partials/footer.php") ?>

    </div>

	<?php require_once("template/partials/javascript.php") ?>
</body>

</html>