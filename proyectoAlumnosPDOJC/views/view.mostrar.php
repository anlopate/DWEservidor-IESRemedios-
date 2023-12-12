<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'layouts/head.html' ?>
    <title>Mostrar Alumno - Proyecto 5.2 - Gestión Alumnos PDO</title>
</head>

<body>
    <!-- Capa principal -->
    <div class="container">
        <!-- Cabecera -->
        <?php include 'partials/header.php' ?>
        <legend>Mostrar Alumno Alumno</legend>

        <!-- Formulario Editar Alumno -->
        <form >

            <div class="mb-3">
                <label class="form-label">Id</label>
                <input type="number" class="form-control" name="id" value="<?=$alumno->id?>" disabled>
            </div>
            <!-- Nombre -->
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="<?= $alumno->nombre ?>" disabled>
            </div>
            <!-- Apellidos -->
            <div class="mb-3">
                <label class="form-label">Apellidos</label>
                <input type="text" class="form-control" name="apellidos" value="<?= $alumno->apellidos ?>" disabled>
            </div>
            <!-- Email -->
            <div class="mb-3">
                <label class="form-label">Correo Electronico</label>
                <input type="email" class="form-control" name="mail" value="<?= $alumno->email ?>" disabled>
            </div>
            <!-- Telefono -->
            <div class="mb-3">
                <label class="form-label">Télefono</label>
                <input type="number" class="form-control" name="telefono" value="<?= $alumno->telefono ?>" disabled>
            </div>
            <!-- Dirección -->
            <div class="mb-3">
                <label class="form-label">Dirección</label>
                <input type="text" class="form-control" name="direccion" value="<?= $alumno->direccion ?>" disabled
            </div>
            <!-- Población -->
            <div class="mb-3">
                <label class="form-label">Población</label>
                <input type="text" class="form-control" name="poblacion" value="<?= $alumno->poblacion ?>" disabled>
            </div>
            <!-- Provincia -->
            <div class="mb-3">
                <label class="form-label">Provincia</label>
                <input type="text" class="form-control" name="provincia" value="<?= $alumno->provincia ?>" disabled>
            </div>
            <!-- Nacionalidad -->
            <div class="mb-3">
                <label class="form-label">Nacionalidad</label>
                <input type="text" class="form-control" name="nacionalidad" value="<?= $alumno->nacionalidad ?>" disabled>
            </div>
            <!-- DNI -->
            <div class="mb-3">
                <label class="form-label">DNI</label>
                <input type="text" class="form-control" name="dni" pattern="[0-9]{8}[A-Z]{1}" value="<?= $alumno->dni ?>" disabled>
            </div>
            <!-- Fecha Nacimiento -->
            <div class="mb-3">
                <label class="form-label">Fecha de Nacimiento</label>
                <input type="date" class="form-control" name="fechaNac" value="<?= $alumno->fechaNac ?>" disabled>
            </div>
            <!-- Curso -->
            <div class="mb-3">
                <label class="form-label">Curso</label>
                <input type="text" class="form-control" value="<?=$curso?>" disabled> 
            </div>

            <a class="btn btn-secondary" href="index.php" role="button">Volver</a>

        </form>
        <br>
        <br>
        <br>


    </div>
    <!-- Pie de documento -->
    <?php include 'partials/footer.html' ?>


    <!-- js bootstrap 532-->
    <?php include 'layouts/javascript.html' ?>
</body>

</html>