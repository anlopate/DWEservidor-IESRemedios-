<!DOCTYPE html>
<html lang="es">

<head>
   <?php require_once("template/partials/head.php") ?>
</head>

<body>
    <!-- Menú principal -->
    <?php require_once("template/partials/menu.php") ?>
    <br><br><br>
    <div class="container">
        <br><br>
        <!-- Header -->
        <?php require_once("views/movimientos/partials/header.php") ?>
         <!-- comprobamos si hay errores -->
         <?php include 'template/partials/error.php' ?>

        <legend><b style="font-family: Arial">Formulario Nuevo Movimiento</b></legend>

        <form action="<?= URL?>movimientos/create" method="POST">   
            <!-- Id_cuenta -->
            <div class="mb-3">
                <label for="id_cuenta" class="form-label">Cuentas</label>
                <select class="form-select <?= (isset($this->errores['id_cuenta']))? 'is-invalid': null ?>" aria-label="Default select example" type="number" name="id_cuenta" value=<?= $this->movimiento->id_cuenta ?>>
                    <option selected>Id Cuenta</option>
                    <?php foreach ($this->listaCuentas as $cuenta): ?>
                        <option value="<?= $cuenta->id ?>">
                        <?= $cuenta->id?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
             <!-- Mostrar posible error -->
             <?php if(isset($this->errores['id_cuenta'])) :  ?>
                <span class="form-text text-danger" role="alert">
                    <?= $this->errores['id_cuenta']; ?>
                </span>
                <?php endif; ?>
                <!-- Fecha/Hora -->
                <div class="mb-3">
                <label for="fecha_hora" class="form-label">Fecha/Hora </label>
                <input type="date" class="form-control " name="fecha_hora" value="<?= date("d-m-Y H:i:s")?>">
            </div>
                <!-- Concepto-->
            <div class="mb-3">
                <label for="concepto" class="form-label">Concepto</label>
                <input type="text" class="form-control <?= (isset($this->errores['concepto']))? 'is-invalid': null ?>" name="concepto" value="<?= $this->movimientos->concepto ?>" required>
            </div>
             <!-- Mostrar posible error -->
             <?php if(isset($this->errores['concepto'])) :  ?>
                <span class="form-text text-danger" role="alert">
                    <?= $this->errores['concepto']; ?>
                </span>
                <?php endif; ?>
                <!-- Tipo-->
                <div class="mb-3">
                <label for="tipo" class="form-label">Tipo</label>
                <input type="text" class="form-control <?= (isset($this->errores['tipo']))? 'is-invalid': null ?>" name="tipo" value="<?= $this->movimientos->tipo ?>" required>
            </div>
             <!-- Mostrar posible error -->
             <?php if(isset($this->errores['tipo'])) :  ?>
                <span class="form-text text-danger" role="alert">
                    <?= $this->errores['tipo']; ?>
                </span>
                <?php endif; ?>
                 <!-- Cantidad-->
                 <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" class="form-control <?= (isset($this->errores['cantidad']))? 'is-invalid': null ?>" name="cantidad" value="<?= $this->movimientos->cantidad ?>" required>
            </div>
             <!-- Mostrar posible error -->
             <?php if(isset($this->errores['cantidad'])) :  ?>
                <span class="form-text text-danger" role="alert">
                    <?= $this->errores['cantidad']; ?>
                </span>
                <?php endif; ?>

           
    
            <!-- <a class="btn btn-secondary" href="cuenta" role="button">Cancelar</a>
            <button type="reset" class="btn btn-danger">Borrar</button>  -->
            <button type="submit" class="btn btn-primary">Enviar</button>

        </form>

        <br>
        <br>
        <br>

       
        <?php include 'template/partials/footer.php' ?>

    </div>
    <?php include 'template/partials/javascript.php' ?>
</body>
</html>