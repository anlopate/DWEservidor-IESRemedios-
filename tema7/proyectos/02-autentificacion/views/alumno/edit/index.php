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
        <?php include 'views/alumno/partials/header.php' ?>

        <!-- comprobamos si hay errores -->
        <?php include 'template/partials/error.php' ?>

        <legend>Formulario Editar Alumno</legend>

        <!-- Formulario Editar Alumno -->
        <form action="<?= URL ?>alumno/update/<?= $this->id ?>" method="POST">

            <!-- id -->
            <!-- <div class="mb-3">
                <label for="titulo" class="form-label">Id</label>
                <input type="text" class="form-control" name="id">
            </div>  -->
            <!-- Nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" value=<?= $this->alumno->nombre ?>>
            </div>
             <!-- Mostrar posible error -->
             <?php if(isset($this->errores['nombre'])) :  ?>
                <span class="form-text text-danger" role="alert">
                    <?= $this->errores['nombre']; ?>
                </span>
                <?php endif; ?>
            <!-- Apellidos -->
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" class="form-control" name="apellidos" value=<?= $this->alumno->apellidos ?>>
            </div>
             <!-- Mostrar posible error -->
             <?php if(isset($this->errores['apellidos'])) :  ?>
                <span class="form-text text-danger" role="alert">
                    <?= $this->errores['apellidos']; ?>
                </span>
                <?php endif; ?>
            <!-- Fecha Nacimiento -->
            <div class="mb-3">
                <label for="fechaNac" class="form-label">Fecha Nacimiento</label>
                <input type="date" class="form-control" name="fechaNac" value=<?= $this->alumno->fechaNac ?>>
            </div>
            <!-- Mostrar posible error -->
            <?php if(isset($this->errores['fechaNac'])) :  ?>
                <span class="form-text text-danger" role="alert">
                    <?= $this->errores['fechaNac']; ?>
                </span>
                <?php endif; ?>
            <!-- Dni -->
            <div class="mb-3">
                <label for="dni" class="form-label">Dni</label>
                <input type="text" class="form-control" name="dni" value=<?= $this->alumno->dni ?>>
            </div>
            <!-- Mostrar posible error -->
            <?php if(isset($this->errores['dni'])) :  ?>
                <span class="form-text text-danger" role="alert">
                    <?= $this->errores['dni']; ?>
                </span>
                <?php endif; ?>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value=<?= $this->alumno->email ?>>
            </div>
             <!-- Mostrar posible error -->
             <?php if(isset($this->errores['email'])) :  ?>
                <span class="form-text text-danger" role="alert">
                    <?= $this->errores['email']; ?>
                </span>
                <?php endif; ?>

            <!-- Telefono -->
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="tel" class="form-control" name="telefono" value=<?= $this->alumno->telefono ?>>
            </div>
            <!-- Mostrar posible error -->
            <?php if(isset($this->errores['telefono'])) :  ?>
                <span class="form-text text-danger" role="alert">
                    <?= $this->errores['telefono']; ?>
                </span>
                <?php endif; ?>
            
           
            <!-- Población -->
            <div class="mb-3">
                <label for="poblacion" class="form-label">Población</label>
                <input type="text" class="form-control" name="poblacion" value=<?= $this->alumno->poblacion ?>>
            </div>
            <!-- Mostrar posible error -->
            <?php if(isset($this->errores['poblacion'])) :  ?>
                <span class="form-text text-danger" role="alert">
                    <?= $this->errores['poblacion']; ?>
                </span>
                <?php endif; ?>
          
            <!-- Curso Select -->
            <div class="mb-3">
                <label for="id_curso" class="form-label">Curso</label>
                <select class="form-select" aria-label="Default select example" name="id_curso">
                    <option selected disabled>Seleccione Curso</option>
                    <?php foreach ($this->cursos as $data): ?>
                        <option value="<?= $data->id ?>"
                            <?= ($data->id == $this->alumno->id_curso)? 'selected' : null ?>
                        >                            <?= $data->curso ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
             <!-- Mostrar posible error -->
             <?php if(isset($this->errores['id_curso'])) :  ?>
                <span class="form-text text-danger" role="alert">
                    <?= $this->errores['id_curso']; ?>
                </span>
                <?php endif; ?>

            <!-- botones de acción -->
            <a class="btn btn-secondary" href="<?= URL ?>alumno" role="button">Cancelar</a>
            <button type="reset" class="btn btn-danger">Reset</button>
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