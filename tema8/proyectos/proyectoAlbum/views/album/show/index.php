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

        <div class="card">
        <div class="card-header">
					<h4>Título: </h4> <h6><?= $this->album->titulo?></h6>
        </div>  
        <table class="table">
            <tr><th>Título: </th><td><?= $this->album->titulo?></td></tr>
            <tr><th>Autor: </th><td><?=$this->album->autor?></td><th>Fecha: </th><td><?=$this->album->fecha?></td></tr>
            <tr><th>Descripción: </th><td><?=$this->album->descripcion?></td><th>Carpeta: </th><td><?= $this->album->carpeta?></td></tr>
            <tr><th>Categoria: </th><td><?=$this->album->categoria?></td><th>Etiqueta: </th><td><?=$this->album->etiquetas?></td></tr>
            </td><th>Número visitas: </th><td><?=$this->album->num_visitas?></td></tr>
            <tr>
                <td>
                <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                <?php $rutaCarpeta = 'images/'.$this->album->carpeta; ?>
                    <?php $directorio = glob($rutaCarpeta . '/*'); ?>
                    <?php foreach($directorio as $imagen): ?>
                                <img src="<?=URL . $imagen?>" class="w-100 shadow-1-strong rounded mb-4" height="200" width="400"/>
                            <?php endforeach; ?>
                        </div>
                    </td>
                    </tr>
                </table>
                <footer>
                    
                <div class="card-footer">
					<small class="text-muted"> <strong>Número de Fotos:</strong>
						<?= $this->album->num_fotos ?>
					</small>
				</div>
           
                </footer>
     
        <br>
        <br>
        <br>
          
        <?php require_once("template/partials/footer.php") ?>
	      <?php require_once("template/partials/javascript.php") ?>
</body>
</html>