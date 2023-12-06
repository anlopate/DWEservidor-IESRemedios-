<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'views/layouts/head.html' ?>
    <title> Proyecto 5. - Maratoon</title>
</head>

<body>
     <!-- Capa principal -->
     <div class="container">

        <!-- cabecera documento -->
        <?php include 'views/partials/header.php' ?>

        <legend>Formulario Nuevo Corredor</legend>

        <!-- Formulario Nuevo Libro -->
        <form action="create.php" method="POST">

            <!-- id -->
            <!-- <div class="mb-3">
                <label for="titulo" class="form-label">Id</label>
                <input type="text" class="form-control" name="id">
            </div>  -->
            <!-- Nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre">
            </div>
            <!-- Apellidos -->
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" class="form-control" name="apellidos">
            </div>
            <!-- Fecha Nacimiento -->
            <div class="mb-3">
                <label for="ciudad" class="form-label">Ciudad</label>
                <input type="text" class="form-control" name="ciudad">
            </div>
            <!-- Email -->
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha Nacimiento</label>
                <input type="date" class="form-control" name="fecha">
            </div>
            <!-- Dni -->
            <div class="mb-3">
                <label for="sexo" class="form-label">Sexo </label><br>  
                <input type="checkbox" class="form-check-input" id="hombre" name="genero" value="hombre">
                <label class="form-check-label">Hombre</label>
                <input type="checkbox" class="form-check-input" id="mujer" name="genero" value="mujer">
                <label class="form-check-label">Mujer</label>
                <input type="checkbox" class="form-check-input" id="sinEsp" name="genero" value="sinEsp">
                <label class="form-check-label">Sin Especificar</label>

            </div>

            <!-- Telefono -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" name="email">
            </div>
            <!-- Dirección -->
            <div class="mb-3">
                <label for="dni" class="form-label">DNI</label>
                <input type="text" class="form-control" name="dni">
            </div>
            <!-- Población -->
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoria</label>
                <select class="form-select" aria-label="Default select example" name="id_categoria">
                     <option selected disable>Seleccione categoria</option>
                      <?php foreach($categorias as $categoria):?>
                        <option value="<?= $categoria->id?>"> <?= $categoria->nombreCorto?> </option>
                      </option>
                      <?php endforeach;?>
                </select>
            </div>
            <!-- Provincia -->
            <div class="mb-3">
                <label for="provincia" class="form-label">Club</label>
                <select class="form-select" aria-label="Default select example" name="id_club">
                    <option selected disable>Seleccione club</option>
                    <?php foreach ($clubs as $club) : ?>
                        <option value="<?=$club->id?>"> <?=$club->nombreCorto?> </option>
                    <?php endforeach;?>
                </select>
            </div>
           
            <!-- botones de acción -->
            <a class="btn btn-secondary" href="index.php" role="button">Cancelar</a>
            <button type="reset" class="btn btn-danger">Borrar</button>
            <button type="submit" class="btn btn-primary">Enviar</button>

        </form>

        <br>
        <br>
        <br>

        <!-- Pié del documento -->
        <?php include 'views/partials/footer.html' ?>

        </div>

        <!-- javascript bootstrap 532 -->
        <?php include 'views/layouts/javascript.html' ?>
</body>

</html>