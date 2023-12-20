<!DOCTYPE html>
<html lang="es">

<head>
     <?php require_once('template/partials/head.php') ?><!--Estilo de la página -->
   <title> <?= $this->title?></title> <!-- Esta propiedad la he creado en el controlador alumno. Método new.-->
</head>

<body>
     <!-- Capa principal -->
     <div class="container">

        <!-- cabecera documento -->
        <?php include 'views/alumno/partials/header.php' ?>

        <legend>Formulario Editar Alumno</legend>

        <!-- Formulario Nuevo Libro -->
        <form action="<?=URL?>alumno/update/<?=$this->id?>" method="POST"> 

            <!-- id oculto-->
            <div class="mb-3">
                <!-- <label for="titulo" class="form-label">Id</label> -->
                <input type="number" class="form-control" name="id" value="<?=$this->$alumno->id?>" hidden>
            </div> 
            <!-- Nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="<?=$this->$alumno->nombre?>">
            </div>
            <!-- Apellidos -->
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" class="form-control" name="apellidos" value="<?=$this->$alumno->apellidos?>">
            </div>
            <!-- Fecha Nacimiento -->
            <div class="mb-3">
                <label for="fechaNac" class="form-label">Fecha Nacimiento</label>
                <input type="date" class="form-control" name="fechaNac" value="<?=$this->$alumno->fechaNac?>">
            </div>
            <!-- Dni -->
            <div class="mb-3">
                <label for="dni" class="form-label">Dni</label>
                <input type="text" class="form-control" name="dni" pattern="[0-9]{8}[A-Z]{1}" value="<?=$this->$alumno->dni?>"><!--validación DNI -->
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="<?=$this->$alumno->email?>">
            </div>
            <!-- Telefono -->
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="tel" class="form-control" name="telefono" value="<?=$alumno->telefono?>">
            </div>
            <!-- Dirección -->
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" class="form-control" name="direccion" value="<?=$this->$alumno->direccion?>">
            </div>
            <!-- Población -->
            <div class="mb-3">
                <label for="poblacion" class="form-label">Población</label>
                <input type="text" class="form-control" name="poblacion" value="<?=$this->$alumno->poblacion?>">
            </div>
            <!-- Provincia -->
            <div class="mb-3">
                <label for="provincia" class="form-label">Provincia</label>
                <input type="text" class="form-control" name="provincia" value="<?=$this->$alumno->provincia?>">
            </div>
            <!-- Nacionalidad -->
            <div class="mb-3">
                <label for="nacionalidad" class="form-label">Nacionalidad</label>
                <input type="text" class="form-control" name="nacionalidad" value="<?=$this->$alumno->nacionalidad?>">
            </div>
            <!-- Curso Select -->
            <div class="mb-3">
                <label for="id_curso" class="form-label">Curso</label>
                <select class="form-select" aria-label="Default select example" name="id_curso" value="<?=$this->$alumno->id_curso?>">
                    
                    <?php foreach ($this->cursos as $data): ?>
                        <option value="<?= $data->id ?>"
                        <?=$this->alumno->id_curso == $data->id ? 'selected' : null ?>
                        
                        >
                            <?= $data->curso?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- botones de acción -->
            <a class="btn btn-secondary" href="<?=URL?>alumno" role="button">Cancelar</a>
            <button type="reset" class="btn btn-danger">Restaurar</button>
            <button type="submit" class="btn btn-primary" >Actualizar</button>

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