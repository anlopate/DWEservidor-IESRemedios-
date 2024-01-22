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
        <!-- Cabecera -->
        <?php require_once("views/cuenta/partials/header.php") ?>

        <legend><b>Formulario Editar Cuenta</b></legend>
        <!-- comprobamos si hay errores -->
        <?php include 'template/partials/error.php' ?>
        <form action="<?= URL ?>cuenta/update/<?= $this->id ?>" method="POST">
            <!-- Número de cuenta -->
            <div class="mb-3">
                <label for="num_cuenta" class="form-label">Número cuenta</label>
                <input type="text" class="form-control" name="num_cuenta" value="<?=$this->cuenta->num_cuenta?>">
            </div>
             <!-- Mostrar posible error número de cuenta-->
             <?php if(isset($this->errores['num_cuenta'])) :  ?>
                <span class="form-text text-danger" role="alert">
                    <?= $this->errores['num_cuenta']; ?>
                </span>
                <?php endif; ?>
                <!-- Nombre cliente -->
                <div class="mb-3">
                <label for="id_cliente" class="form-label">Lista clientes</label>
                <select class="form-select" aria-label="Default select example" type="number" name="id_cliente" value=<?= $this->cuenta->id_cliente ?>>
                    <option selected>Nombre Cliente</option>
                    <?php foreach ($this->listaClientes as $client): ?>
                        <option value="<?= $client->id ?>">
                            <?= $client->apellidos ?>
                            <?= $client->nombre ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
             <!-- Mostrar posible nombre cliente -->
             <?php if(isset($this->errores['id_cliente'])) :  ?>
                <span class="form-text text-danger" role="alert">
                    <?= $this->errores['id_cliente']; ?>
                </span>
                <?php endif; ?>
                <!-- Fecha de alta -->
            <div class="mb-3">
                <label for="fecha_alta" class="form-label">Fecha Alta</label>
                <input type="date_create_from_format" class="form-control" name="fecha_alta" value="<?=$this->cuenta->fecha_alta?>" readonly>
            </div>
                <!-- Fecha último movimiento -->
            <div class="mb-3">
                <label for="fecha_ul_mov" class="form-label">Fecha Último Movimiento</label>
                <input type="date_create_from_format" class="form-control" name="fecha_ul_mov" value="<?=$this->cuenta->fecha_ul_mov?>" readonly>
            </div>
                <!-- Número de movimientos -->
            <div class="mb-3">
                <label for="num_movtos" class="form-label">Número Movimientos</label>
                <input type="number" class="form-control" name="num_movtos" value="<?=$this->cuenta->num_movtos?>" readonly>
            </div>
            <!-- Saldo -->
            <div class="mb-3">
                <label for="saldo" class="form-label">Saldo</label>
                <input type="number" class="form-control" name="saldo" value="<?=$this->cuenta->saldo?>" readonly>
            </div>
                <!-- Botón de acción -->
            <button type="submit" class="btn btn-primary">Editar</button>

        </form>

        <br>
        <br>
        <br>

        <?php include 'template/partials/footer.php' ?>

    </div>

    
    <?php include 'template/partials/javascript.php' ?>
</body>

</html>