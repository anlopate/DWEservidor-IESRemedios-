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
                <label class="form-label">Número de cuenta</label>
                <input type="text" class="form-control" value="<?= $this->cuenta->num_cuenta?>" disabled>
            </div>
            <div class="mb-3">
                <label class="form-label">Cliente</label>
                <input type="text" class="form-control" name="num_cuenta" value="<?=$this->cuenta->cliente?>" disabled>
            </div>
           
            <div class="mb-3">
                <label class="form-label">Fecha de alta</label>
                <input type="number" class="form-control" name="fecha_alta" value="<?=$this->cuenta->fecha_alta?>" disabled>
            </div>
          
            <div class="mb-3">
                <label class="form-label">Fecha último movimiento</label>
                <input type="text" class="form-control" name="fecha_ul_mov" value="<?=$this->cuenta->fecha_ul_mov?>" disabled>
            </div>
          
            <div class="mb-3">
                <label class="form-label">Número movimientos</label>
                <input type="text" class="form-control" name="num_movto" value="<?=$this->cuenta->num_movtos?>" disabled>
            </div>

            <div class="mb-3">
                <label class="form-label">Saldo</label>
                <input type="text" class="form-control" name="saldo" value="<?=$this->cuenta->saldo?>" disabled>
            </div>

            <div class="mb-3">
                <a class="btn btn-secondary" href="<?=URL?>cuenta" role="button">Volver</a>
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