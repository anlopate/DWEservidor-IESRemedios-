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
        
        <?php require_once("views/cliente/partials/header.php") ?>

        <form>
          
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="<?=$this->cliente->nombre?>" disabled>
            </div>
            <div class="mb-3">
                <label class="form-label">Apellidos</label>
                <input type="text" class="form-control" name="apellidos" value="<?=$this->cliente->apellidos?>" disabled>
            </div>
           
            <div class="mb-3">
                <label class="form-label">Correo Electronico</label>
                <input type="email" class="form-control" name="email" value="<?=$this->cliente->email?>" disabled>
            </div>
           
            <div class="mb-3">
                <label class="form-label">Télefono</label>
                <input type="number" class="form-control" name="telefono" value="<?=$this->cliente->telefono?>" disabled>
            </div>
          
            <div class="mb-3">
                <label class="form-label">Ciudad</label>
                <input type="text" class="form-control" name="ciudad" value="<?=$this->cliente->ciudad?>" disabled>
            </div>
          
            <div class="mb-3">
                <label class="form-label">DNI</label>
                <input type="text" class="form-control" name="dni" pattern="[0-9]{8}[A-Z]{1}" value="<?=$this->cliente->dni?>" disabled>
            </div>

            <div class="mb-3">
                <a class="btn btn-secondary" href="<?=URL?>cliente" role="button">Volver</a>
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