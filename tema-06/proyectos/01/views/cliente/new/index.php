<!DOCTYPE html>
<html lang="es">

<head>
    <!-- bootstrap -->
    <?php require_once("template/partials/head.php") ?>
    <title>Tabla Clientes - Gesbank</title>
</head>

<body>
        <!-- Menú fijo superior -->
        <?php require_once("template/partials/menu.php") ?>
        <br><br><br>
        <!-- Capa principal -->
        <div class="container">
        <br><br>
       
         <!-- comprobamos si hay errores -->
         <?php include 'views/cliente/partials/header.php' ?>
        <legend><b>Formulario Nuevo cliente</b></legend>
       
        <form action="<?=URL?>cliente/create" method="POST">
            <!-- Nombre -->
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" value=<?= $this->cliente->nombre ?>>
            </div>
             <!-- Mostrar posible error nombre -->
             <?php if(isset($this->errores['nombre'])) :  ?>
                <span class="form-text text-danger" role="alert">
                    <?= $this->errores['nombre']; ?>
                </span>
                <?php endif; ?>
           <!-- Apellidos -->
            <div class="mb-3">
                <label class="form-label">Apellidos</label>
                <input type="text" class="form-control" name="apellidos" value=<?= $this->cliente->apellidos ?>>
            </div>
             <!-- Mostrar posible error apellidos -->
             <?php if(isset($this->errores['apellidos'])) :  ?>
                <span class="form-text text-danger" role="alert">
                    <?= $this->errores['apellidos']; ?>
                </span>
                <?php endif; ?>
            <!-- Email -->
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value=<?= $this->cliente->email ?>>
            </div>
             <!-- Mostrar posible error email -->
             <?php if(isset($this->errores['email'])) :  ?>
                <span class="form-text text-danger" role="alert">
                    <?= $this->errores['email']; ?>
                </span>
                <?php endif; ?>
           <!-- Teléfono -->
            <div class="mb-3">
                <label class="form-label">Télefono</label>
                <input type="number" class="form-control" name="telefono" value=<?= $this->cliente->telefono ?>>
            </div>
              <!-- Mostrar posible teléfono -->
              <?php if(isset($this->errores['telefono'])) :  ?>
                <span class="form-text text-danger" role="alert">
                    <?= $this->errores['telefono']; ?>
                </span>
                <?php endif; ?>
            <!-- Ciudad -->
            <div class="mb-3">
                <label class="form-label">Ciudad</label>
                <input type="text" class="form-control" name="ciudad" value=<?= $this->cliente->ciudad ?>>
            </div>
             <!-- Mostrar posible error ciudad -->
             <?php if(isset($this->errores['ciudad'])) :  ?>
                <span class="form-text text-danger" role="alert">
                    <?= $this->errores['ciudad']; ?>
                </span>
                <?php endif; ?>
           <!-- DNI -->
            <div class="mb-3">
                <label class="form-label">DNI</label>
                <input type="text" class="form-control" name="dni" value=<?= $this->cliente->dni ?>>
            </div>
            <!-- Mostrar posible DNI -->
            <?php if(isset($this->errores['dni'])) :  ?>
                <span class="form-text text-danger" role="alert">
                    <?= $this->errores['dni']; ?>
                </span>
                <?php endif; ?>

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