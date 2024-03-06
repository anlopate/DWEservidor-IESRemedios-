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
        <?php require_once("views/cuenta/partials/header.php") ?>
         <!-- comprobamos si hay errores -->
         <?php include 'template/partials/error.php' ?>

        <legend><b>Formulario Nueva cuenta</b></legend>

        <form action="<?= URL?>cuenta/create" method="POST">   
            <!-- Número de cuenta -->
            <div class="mb-3">
                <label for="num_cuenta" class="form-label">Número Cuenta</label>
                <input type="number"class="form-control <?= (isset($this->errores['num_cuenta']))? 'is-invalid': null ?>" name="num_cuenta" max_lenght="20" value=<?= $this->cuenta->num_cuenta ?>>
            </div>
             <!-- Mostrar posible error -->
             <?php if(isset($this->errores['num_cuenta'])) :  ?>
                <span class="form-text text-danger" role="alert">
                    <?= $this->errores['num_cuenta']; ?>
                </span>
                <?php endif; ?>

                <!-- Clientes -->
            <div class="mb-3">
                <label for="id_cliente" class="form-label">Lista clientes</label>
                <select class="form-select <?= (isset($this->errores['id_cliente']))? 'is-invalid': null ?>" aria-label="Default select example" type="number" name="id_cliente" value=<?= $this->cuenta->id_cliente ?>>
                    <option selected>Nombre Cliente</option>
                    <?php foreach ($this->listaClientes as $client): ?>
                        <option value="<?= $client->id ?>">
                            <?= $client->apellidos ?>
                            <?= $client->nombre ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
             <!-- Mostrar posible error nombre cliente -->
             <?php if(isset($this->errores['id_cliente'])) :  ?>
                <span class="form-text text-danger" role="alert">
                    <?= $this->errores['id_cliente']; ?>
                </span>
                <?php endif; ?>
                <!-- Fecha alta -->
            <div class="mb-3">
                <label for="fecha_alta" class="form-label">Fecha de alta nueva cuenta</label>
                <input type="date_timestamp_get" class="form-control " name="fecha_alta" value="<?= date("d-m-Y H:i:s")?>" required>
            </div>
            <div class="mb-3">
                <label for="saldo" class="form-label">Saldo inicial</label>
                <input type="number" class="form-control" name="saldo" min="0" step="0.01" value="0" value=<?= $this->cuenta->saldo ?>>
            </div>
    
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