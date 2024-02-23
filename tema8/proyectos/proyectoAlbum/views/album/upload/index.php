<!doctype html>
<html lang="es">

<!-- head -->
<head>
	<?php require_once("template/partials/head.php") ?>
	<title>
		<?= $this->title ?>
</title>

<head>
<body>
    <!-- Menú Principal -->
    <?php require_once("template/partials/menuAut.php") ?>
    <br><br><br>
    <!-- Page Content -->
    <div class="container">
        <!-- cabecera  -->
        <?php require_once("views/album/partials/header.php") ?>
       
        <!-- errores -->
        <?php require_once("template/partials/error.php") ?>
      
        <h4>Seleccione una imagen</h4>
        <br>
       
      <!-- Formulario -->
      <form method="POST" enctype="multipart/form-data" action="<?=URL?>/album/enviarImagen/<?=$this->id?>">
     <!-- Campo oculto validar tamaño archivo. El name tiene que ser el que se indica. El value es el tamaño, en este caso 5 MB -->
     <input type="hidden" name="MAX_FILE_SIZE" value="5242880">
             <!-- Fichero -->
             <div class="mb-3">
                <label for="formFile" class="form-label">Seleccione Imagen</label>
                <!-- La etiqueta accept indica qué tipo de archivo se puede subir. En este caso múltiples archivos de tipo PNG, JPG, GIF-->
                <input type="file" name="fichero[]" class="form-control" id="formFile" multiple accept=".png, .jpg, .gif"/>
                <!-- Error -->
                <span class="form-text text-danger" role="alert"><?=$errores['fichero']??=null?></span>
            </div>
             <!-- Botones acción -->
             <button class="btn btn-primary" type="submit">Enviar</button>
    </form>
    </div>    
   
   <?php require_once('template/partials/footer.php')?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</div>
</body>
</html> 
