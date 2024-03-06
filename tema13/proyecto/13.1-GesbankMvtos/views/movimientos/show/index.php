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
        
        <?php require_once("views/movimientos/partials/header.php") ?>

        <form>
            <div class="mb-3">
                <label class="form-label">Id movimiento</label>
                <input type="text" class="form-control" value="<?= $this->movimiento->id?>" disabled>
            </div>
            <div class="mb-3">
                <label class="form-label">Id cuenta</label>
                <input type="text" class="form-control" name="id_cuenta" value="<?=$this->movimiento->id_cuenta?>" disabled>
            </div>
           
            <div class="mb-3">
                <label class="form-label">Fecha/Hora</label>
                <input type="timestamp" class="form-control" name="fecha_hora" value="<?=$this->movimiento->fecha_hora?>" disabled>
            </div>
          
            <div class="mb-3">
                <label class="form-label">Concepto</label>
                <input type="text" class="form-control" name="concepto" value="<?=$this->movimiento->concepto?>" disabled>
            </div>
          
            <div class="mb-3">
                <label class="form-label">Tipo</label>
                <input type="text" class="form-control" name="tipo" value="<?=$this->movimiento->tipo?>" disabled>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Cantidad</label>
                <input type="text" class="form-control" name="cantidad" value="<?=$this->movimiento->cantidad?>" disabled>
            </div>

            <div class="mb-3">
                <label class="form-label">Saldo</label>
                <input type="text" class="form-control" name="saldo" value="<?=$this->movimiento->saldo?>" disabled>
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