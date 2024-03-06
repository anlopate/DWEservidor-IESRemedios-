<!DOCTYPE html>
<html lang="es">

<head>
    <!-- bootstrap -->
    <?php require_once("template/partials/head.php") ?>
    <title>Tabla Cuentas - Gesbank</title>
</head>

<body>
        <!-- Menú fijo superior -->
        <?php require_once("template/partials/menuAut.php") ?>
        <br><br><br>
        <!-- Capa principal -->
        <div class="container">
        <br><br>
       
         <!-- Header -->
         <?php include 'views/cuenta/partials/header.php' ?>

         
        <!-- comprobamos si existe error -->
        <?php include 'template/partials/error.php' ?>
        
        <h1>Subir archivo</h1>
        <br>
        <!-- Formulario -->
        <form method="POST" enctype="multipart/form-data" action="<?=URL?>/cuenta/enviarCSVCarpeta/<?=$this->id?>">
    
        <div class="mb-3">
            <label for="formFile" class="form-label">Seleccione archivo</label>
            <input type="file" name="archivo[]" class="form-control" id="formFile" accept=".csv"/>
            <!-- Error -->
            <span class="form-text text-danger" role="alert"><?=$errores['archivo']??=null?></span>
        </div>
        <!-- Botón acción -->
        <button class="btn btn-primary" type="submit">Enviar</button>
        </form>
    </div>
       
        <?php require_once("template/partials/footer.php") ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    </div>

	<?php require_once("template/partials/javascript.php") ?>
</body>

</html>