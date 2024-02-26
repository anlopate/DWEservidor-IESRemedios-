<!DOCTYPE html>
<html lang="es">

<head>
    <!-- bootstrap -->
    <?php require_once("template/partials/head.php") ?>
    <title>Gesbank Contacto</title>
    <br><br><br>
</head>
<body>
        <!-- Menú fijo superior -->
        <?php require_once("template/partials/menuAut.php") ?>
        <!-- Capa principal -->
        <div class="container">
            <!-- Header -->
            <?php include 'views/contactar/partials/header.php' ?>
            <!-- comprobamos si existe error -->
            <?php include 'template/partials/error.php' ?>
    
                <legend><b>Formulario de contacto</b></legend>
            
                <form action="<?=URL?>contactar/validar" method="POST">
                    <!-- Nombre -->
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control <?= (isset($this->errores['nombre'])) ? 'is-invalid' : null ?>" name="nombre" style="width:500px">
                    </div>
                    <!-- Mostrar posible error nombre -->
                    <?php if(isset($this->errores['nombre'])) :  ?>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->errores['nombre']; ?>
                        </span>
                        <?php endif; ?>
                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control <?= (isset($this->errores['email'])) ? 'is-invalid' : null ?>"" name="email" style="width:500px" >
                    </div>
                    <!-- Mostrar posible error email -->
                    <?php if(isset($this->errores['email'])) :  ?>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->errores['email']; ?>
                        </span>
                        <?php endif; ?>
                <!-- Asunto -->
                    <div class="mb-3">
                        <label class="form-label">Asunto</label>
                        <input type="text" class="form-control <?= (isset($this->errores['asunto'])) ? 'is-invalid' : null ?>" name="asunto" style="width:500px">
                    </div>
                    <!-- Mostrar posible asunto -->
                    <?php if(isset($this->errores['asunto'])) :  ?>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->errores['asunto']; ?>
                        </span>
                        <?php endif; ?>
                    <!-- Mensaje -->
                    <div class="mb-3">
                        <!-- <input type="text" class="form-control" name="ciudad"> -->
                        <label class="form-label">Mensaje</label><br>
                        <textarea class="form-control <?= (isset($this->errores['asunto'])) ? 'is-invalid' : null ?>" rows="8" cols="80" name="mensaje"></textarea>
                    </div>
                    <!-- Mostrar posible error mensaje -->
                    <?php if(isset($this->errores['mensaje'])) :  ?>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->errores['mensaje']; ?>
                        </span>
                        <?php endif; ?>
                    <div class="mb-3">
                        <a name="" id="" class="btn btn-secondary" href="<?= URL ?>contactar" role="button">Cancelar</a>
                        <button type="reset" class="btn btn-danger">Borrar</button>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </form>
                    <br>
                    <br>
                    <br>
        </div>
       
        <?php require_once("template/partials/footer.php") ?>
	<?php require_once("template/partials/javascript.php") ?>
</body>

</html>