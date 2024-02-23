<!DOCTYPE html>
<html lang="es">

<head>
    <!-- head -->
    <?php require_once("template/partials/head.php") ?>
    <title><?= $this->title ?></title>
</head>

<body>
    <!-- Menú Principal -->
	<?php require_once("template/partials/menuAut.php") ?>
	<br><br><br>

    <!-- Capa principal -->
    <div class="container">

        <!-- header -->
        <?php include 'views/album/partials/header.php' ?>

        <!-- comprobamos si existe error -->
        <?php include 'template/partials/error.php' ?>

        <legend>Formulario Nuevo Album</legend>

        <!-- Formulario Nuevo album -->
        <form action="<?= URL ?>album/create" method="POST">

         <!-- Título -->
         <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" name="titulo" value="<?=$this->album->titulo ?>">
                 <!-- Mostrar posible error -->
                 <?php if(isset($this->errores['titulo'])): ?>
                    <span class="form-text text-danger" role="alert">
                            <?= $this->errores['titulo'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <!-- Descripción -->
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <input type="text" class="form-control" name="descripcion" value="<?=$this->album->descripcion ?>">
                 <!-- Mostrar posible error -->
                 <?php if(isset($this->errores['descripcion'])): ?>
                    <span class="form-text text-danger" role="alert">
                            <?= $this->errores['descripcion'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <!-- Autor -->
            <div class="mb-3">
                <label for="autor" class="form-label">Autor</label>
                <input type="text" class="form-control" name="autor" value="<?=$this->album->autor ?>">
                <!-- Mostrar posible error -->
                <?php if(isset($this->errores['autor'])): ?>
                    <span class="form-text text-danger" role="alert">
                            <?= $this->errores['autor'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <!-- Fecha -->
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" class="form-control" name="fecha" value="<?=$this->album->fecha ?>">
                <!-- Mostrar posible error -->
                <?php if(isset($this->errores['fecha'])): ?>
                    <span class="form-text text-danger" role="alert">
                            <?= $this->errores['fecha'] ?>
                    </span>
                <?php endif; ?>
            </div>

            <!-- Lugar -->
            <div class="mb-3">
                <label for="lugar" class="form-label">Lugar</label>
                <input type="lugar" class="form-control" name="lugar" value="<?=$this->album->lugar ?>">
                 <!-- Mostrar posible error -->
                 <?php if(isset($this->errores['lugar'])): ?>
                    <span class="form-text text-danger" role="alert">
                            <?= $this->errores['lugar'] ?>
                    </span>
                <?php endif; ?>
            </div>

            <!-- Categoría -->
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoría</label>
                <input type="categoria" class="form-control" name="categoria" value="<?=$this->album->categoria ?>">
                 <!-- Mostrar posible error -->
                 <?php if(isset($this->errores['categoria'])): ?>
                    <span class="form-text text-danger" role="alert">
                            <?= $this->errores['categoria'] ?>
                    </span>
                <?php endif; ?>
            </div>

            <!-- Etiquetas -->
            <div class="mb-3">
                <label for="etiquetas" class="form-label">Etiquetas</label>
                <input type="etiquetas" class="form-control" name="etiquetas" value="<?=$this->album->etiquetas ?>">
                 <!-- Mostrar posible error -->
                 <?php if(isset($this->errores['etiquetas'])): ?>
                    <span class="form-text text-danger" role="alert">
                            <?= $this->errores['etiquetas'] ?>
                    </span>
                <?php endif; ?>
            </div>

            <!-- Num_fotos -->
            <div class="mb-3">
                <label for="num_fotos" class="form-label">Num_fotos</label>
                <input type="num_fotos" class="form-control" name="num_fotos" value="<?=$this->album->num_fotos ?>">
                 <!-- Mostrar posible error -->
                 <?php if(isset($this->errores['num_fotos'])): ?>
                    <span class="form-text text-danger" role="alert">
                            <?= $this->errores['num_fotos'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <!-- Num_visitas -->
            <div class="mb-3">
                <label for="num_visitas" class="form-label">Num_visitas</label>
                <input type="num_visitas" class="form-control" name="num_visitas" value="<?=$this->album->num_visitas ?>">
                 <!-- Mostrar posible error -->
                 <?php if(isset($this->errores['num_visitas'])): ?>
                    <span class="form-text text-danger" role="alert">
                            <?= $this->errores['num_visitas'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <!-- Carpeta -->
            <div class="mb-3">
                <label for="carpeta" class="form-label">Carpeta</label>
                <input type="carpeta" class="form-control" name="carpeta"  pattern="^\S(.*\S)?$" value="<?=trim($this->album->carpeta) ?>">
                 <!-- Mostrar posible error -->
                 <?php if(isset($this->errores['carpeta'])): ?>
                    <span class="form-text text-danger" role="alert">
                            <?= $this->errores['carpeta'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <!-- botones de acción -->
            <a class="btn btn-secondary" href="<?= URL ?>album" role="button">Cancelar</a>
            <button type="reset" class="btn btn-danger">Borrar</button>
            <button type="submit" class="btn btn-primary">Enviar</button>

        </form>

        <br>
        <br>
        <br>

        <!-- Pié del documento -->
        <?php include 'template/partials/footer.php' ?>

    </div>

    <!-- javascript bootstrap 532 -->
    <?php include 'template/partials/javascript.php' ?>
</body>

</html>