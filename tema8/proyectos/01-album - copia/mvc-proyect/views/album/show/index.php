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
        
        <?php require_once("views/album/partials/header.php") ?>

        <form >
          
            <div class="mb-3">
                <label class="form-label">Título</label>
                <input type="text" class="form-control" name="titulo" value="<?= $this->album->titulo?>" disabled>
            </div>
            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <input type="text" class="form-control" name="descripcion" value="<?=$this->album->descripcion?>" disabled>
            </div>
           
            <div class="mb-3">
                <label class="form-label">Autor</label>
                <input type="text" class="form-control" name="autor" value="<?=$this->album->autor?>" disabled>
            </div>
           
            <div class="mb-3">
                <label class="form-label">Fecha</label>
                <input type="text" class="form-control" name="fecha" value="<?=$this->album->fecha?>" disabled>
            </div>
          
            <div class="mb-3">
                <label class="form-label">Lugar</label>
                <input type="text" class="form-control" name="lugar" value="<?=$this->album->lugar?>" disabled>
            </div>
          
            <div class="mb-3">
                <label class="form-label">Categoría</label>
                <input type="text" class="form-control" name="categoria"  value="<?=$this->album->categoria?>" disabled>
            </div>

            <div class="mb-3">
                <label class="form-label">Etiquetas</label>
                <input type="text" class="form-control" name="etiquetas"  value="<?=$this->album->etiquetas?>" disabled>
            </div>

            <div class="mb-3">
                <label class="form-label">Num_fotos</label>
                <input type="text" class="form-control" name="num_fotos"  value="<?=$this->album->num_fotos?>" disabled>
            </div>

            <div class="mb-3">
                <label class="form-label">Num_visitas</label>
                <input type="text" class="form-control" name="num_visitas"  value="<?=$this->album->num_visitas?>" disabled>
            </div>
            <div class="mb-3">
                <a class="btn btn-secondary" href="<?=URL?>album" role="button">Volver</a>
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