<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once("template/partials/head.php") ?>
    <title>
        <?= $this->title ?>
    </title>
</head>

<body>
    
    <?php require_once("template/partials/menu.php") ?>
    <br><br><br>

    <div class="container">

        <legend>Formulario Editar Cuenta</legend>

        <form action="<?= URL ?>cuenta/update/<?= $this->cuenta->id ?>" method="POST">

          
            <input type="number" class="form-control" name="id" value="<?= $this->cuenta->id ?>" hidden>

            <div class="mb-3">
                <label for="num_cuenta" class="form-label">Número cuenta</label>
                <input type="text" class="form-control" name="num_cuenta" value="<?=$this->cuenta->num_cuenta?>" onlyread>
            </div>

           
            <div class="mb-3">
                <label for="fecha_alta" class="form-label">Fecha Alta</label>
                <input type="date" class="form-control" name="fecha_alta" value="<?=$this->cuenta->fecha_alta?>" onlyread>
            </div>

            
            <div class="mb-3">
                <label for="fecha_ul_mov" class="form-label">Fecha Último Movimiento</label>
                <input type="date" class="form-control" name="fecha_ul_mov" value="<?=$this->cuenta->fecha_ul_mov?>" onlyread>
            </div>

            
            <div class="mb-3">
                <label for="num_movtos" class="form-label">Número Movimientos</label>
                <input type="number" class="form-control" name="num_movtos" value="<?=$this->cuenta->num_movtos?>" onlyread>
            </div>
            
            <div class="mb-3">
                <label for="saldo" class="form-label">Saldo</label>
                <input type="number" class="form-control" name="saldo" value="<?=$this->cuenta->saldo?>">
            </div>

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