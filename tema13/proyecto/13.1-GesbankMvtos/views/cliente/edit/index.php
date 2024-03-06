<!DOCTYPE html>
<html lang="es">

<head>
<?php require_once("template/partials/head.php") ?>
</head>

<body>
       <?php require_once("template/partials/menuAut.php") ?>
        <br><br><br>
    <div class="container">
        <br><br>
       
        <?php require_once("views/cliente/partials/header.php") ?>
        <legend><b>Formulario Editar Cliente</b></legend>
        <!-- Comprobar si hay errores -->
        <?php include 'template/partials/error.php' ?>
        
        <form action="<?=URL?>cliente/update/<?=$this->id?>" method="POST">
          
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="<?=$this->cliente->nombre?>">
                <!-- Mostrar posible error -->
                <?php if (isset($this->errores['nombre'])) : ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['nombre'] ?>
                    </span>
                    <?php endif; ?>
                </div>
      
           
            <div class="mb-3">
                <label class="form-label">Apellidos</label>
                <input type="text" class="form-control" name="apellidos" value="<?=$this->cliente->apellidos?>">
                <!-- Mostrar posible error -->
                <?php if (isset($this->errores['apellidos'])) : ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['apellidos'] ?>
                    </span>
                    <?php endif; ?>
                </div>
       
           
            <div class="mb-3">
                <label class="form-label">Correo Electronico</label>
                <input type="email" class="form-control" name="email" value="<?=$this->cliente->email?>">
                
                <!-- Mostrar posible error -->
                <?php if (isset($this->errores['email'])) : ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['email'] ?>
                    </span>
                    <?php endif; ?>
                </div>
       
           
            <div class="mb-3">
                <label class="form-label">Télefono</label>
                <input type="number" class="form-control" name="telefono" value="<?=$this->cliente->telefono?>">
                <!-- Mostrar posible error -->
                <?php if (isset($this->errores['telefono'])) : ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['telefono'] ?>
                    </span>
                    <?php endif; ?>
                </div>
                    
           
            <div class="mb-3">
                <label class="form-label">Ciudad</label>
                <input type="text" class="form-control" name="ciudad" value="<?=$this->cliente->ciudad?>">
                <!-- Mostrar posible error -->
                <?php if (isset($this->errores['ciudad'])) : ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['ciudad'] ?>
                    </span>
                    <?php endif; ?>
                </div>
        
           
            <div class="mb-3">
                <label class="form-label">DNI</label>
                <input type="text" class="form-control" name="dni" pattern="[0-9]{8}[A-Z]{1}" value="<?=$this->cliente->dni?>">
                <?php if (isset($this->errores['dni'])) : ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['dni'] ?>
                    </span>
                    <?php endif; ?>
                </div>

            <div class="mb-3">
            <a name="" id="" class="btn btn-secondary" href="<?= URL ?>cliente" role="button">Cancelar</a>
            <button type="reset" class="btn btn-danger">Borrar</button>
            <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>

        </form>
    </div>
        <br>
        <br>
        <br>
      
        <?php require_once("template/partials/footer.php") ?>



	<?php require_once("template/partials/javascript.php") ?>
</body>

</html>