<?php
  # Iniciamos o continuamos sesión
  session_start();

  # Iniciar los campos del formulario
  $nombre = null;
  $observaciones = null;
  $fichero = null;

  # Compruebo si existe algún error.
  if (isset($_SESSION['error'])){
    $errores = $_SESSION['errores'];
    $error = $_SESSION['error'];
    // Autocompleta el formulario.
    $nombre = $_SESSION['nombre'];
    $observaciones = $_SESSION['observaciones'];
    $fichero = $_SESSION['fichero'];
    // Elimina las variables de error.
    unset($_SESSION['error']);
    unset($_SESSION['errores']);
    unset($_SESSION['nombre']);
    unset($_SESSION['observaciones']);
    unset($_SESSION['fichero']);
  
  }

  # Compruebo si existe algún mensaje
  if(isset($_SESSION['mensaje'])){
    $mensaje = $_SESSION['mensaje'];
    unset($_SESSION['mensaje']);
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
      <br><br><br>
      <h1>Formulario subida archivos</h1>
      <!--Mensaje-->
      <?php if (isset($mensaje)):?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Mensaje </strong> <?= $mensaje; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </button>   
            </div>
      <?php endif;?>
      <!--Error-->
      <?php if (isset($error)):?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <strong>Error</strong> <?= $error; ?>
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
      <?php endif;?>
    <!-- Formulario -->
    <form action="validar.php" method="POST"  enctype="multipart/form-data" >
        <!-- Campo oculto validar tamaño archivo. El name tiene que ser el que se indica. El value es el tamaño, en este caso 2 mg -->
        <input type="hidden" name="MAX_FILE_SIZE" value="2097152">
            <!-- Nombre -->
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" id="exampleFormControlInput1" placeholder="Nombre completo" value="<?= $nombre?>">
                <!-- Error -->
                <span class="form-text text-danger" role="alert"><?= $errores['nombre'] ??= null ?></span>
            </div>
            <!-- Observaciones -->
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Observaciones</label>
                <textarea  name="observaciones" class="form-control" id="exampleFormControlTextarea1" rows="3" <?=$observaciones?>></textarea>
                <!-- Error -->
                <span class="form-text text-danger" role="alert"><?= $errores['observaciones'] ??= null ?></span>
            </div>
            <!-- Fichero -->
            <div class="mb-3">
                <label for="formFile" class="form-label">Seleccione Archivo</label>
                <!-- La etiqueta accept indica qué tipo de archivo se puede subir. Archivos imagen con cualquier extensión -->
                <input type="file" name="fichero" class="form-control" id="formFile" accept="image/*" value="<?=$fichero?>">
                <!-- Error -->
                <span class="form-text text-danger" role="alert"><?= $errores['fichero'] ??= null ?></span>
            </div>
           
             <!-- Botones acción -->
             <button class="btn btn-primary" type="submit">Enviar</button>
    </form>
    </div> 
        
    <!-- Pie del documento -->
    <footer class="footer mt-auto py-3 fixed-bottom bg-light" >
        <div class="container">
            <span >Ana López Atero</span>
        </div>
    <!---->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>