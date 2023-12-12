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

        <legend>Formulario Editar Corredor</legend>

        <!-- Formulario Nuevo Libro -->
        <form action="update.php?id=<?=$corredor->id?>" method="POST">

            <!-- id -->
            <div class="mb-3">
                <label for="titulo" class="form-label">Id</label>
                <input type="text" class="form-control" name="id" value="<?=$corredor->id?>" readonly>
            </div>
            <!-- Nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="<?=$corredor->nombre?>" disabled>
            </div>
            <!-- Apellidos -->
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" class="form-control" name="apellidos" value="<?=$corredor->apellidos?>" disabled>
            </div>
            <!-- Fecha Nacimiento -->
            <div class="mb-3">
                <label for="ciudad" class="form-label">Ciudad</label>
                <input type="text" class="form-control" name="ciudad" value="<?=$corredor->ciudad?>" disabled>
            </div>
            <!-- Email -->
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha Nacimiento</label>
                <input type="date" class="form-control" name="fecha" value="<?=$corredor->fechaNacimiento?>" disabled>
            </div>
            <!-- Dni -->
            <div class="mb-3">
                <label for="sexo" class="form-label">Sexo</label>
                <input type="checkbox" id="hombre" name="genero" class="form-check-input" disabled>
                <label for="hombre" class="form-check-label">Hombre</label>
                <input type="checkbox" id="mujer" name="genero" class="form-check-input" disabled>
                <label for="mujer" class="form-check-label">Mujer</label>
                <input type="checkbox" id="sinesp" name="genero" class="form-check-input" disabled>
                <label for="sinEso" class="form-check-label">Sin especificar</label>

            </div>

            <!-- Telefono -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" name="email" value="<?=$corredor->email?>" disabled>
            </div>
            <!-- Dirección -->
            <div class="mb-3">
                <label for="dni" class="form-label">DNI</label>
                <input type="text" class="form-control" name="dni" value="<?=$corredor->dni?>" disabled>
            </div>
            <!-- Población -->
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoria</label>
                <select class="form-select" aria-label="Default select example" name="categoria" disabled>
                    <option selected disabled >Seleccione categoria</option>
                    <?php foreach ($categorias as $categoria):?>
                        <option value="<?=$corredor->id?>" <?= $corredor->id_categoria == $categoria->id ? 'selected' : null ?>>  
                            <?= $categoria->nombreCorto?>
                    </option>
                    <?php endforeach; ?> 
                </select>
                
            </div>
            <!-- Provincia -->
            <div class="mb-3">
                <label for="provincia" class="form-label">Club</label>
                <select class="form-select" aria-label="Default select example" name="club" disabled>
                <option selected disabled>Seleccione club</option>
                <?php foreach ($clubs as $club):?>
                <option value="<?= $club->id ?>" <?= $corredor->id_club == $club->id ? 'selected' : null ?>>
                            <?= $club->nombreCorto ?>
                    </option>
                    <?php endforeach; ?>       
              </select>
            </div>
           
            <!-- botones de acción -->
           <!-- <a class="btn btn-secondary" href="index.php" role="button">Cancelar</a>
            <button type="reset" class="btn btn-danger">Borrar</button>
            <button type="submit" class="btn btn-primary">Enviar</button>-->
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