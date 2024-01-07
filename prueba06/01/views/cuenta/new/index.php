<!DOCTYPE html>
<html lang="es">

<head>
    <!-- head -->
    <?php require_once("template/partials/head.php") ?>
    <title>
        <?= $this->title ?>
    </title>
</head>

<body>
   
    <?php require_once("template/partials/menu.php") ?>
    <br><br><br>

   
    <div class="container">

       
        <?php include 'template/partials/head.php' ?>

        <legend>Formulario Nueva cuenta</legend>

        
        <form action="<?= URL ?>cuenta/create" method="POST">

            
            <div class="mb-3">
                <label for="nombre" class="form-label">Número Cuenta</label>
                <input type="number" class="form-control" name="num_cuenta">
            </div>

        
            <div class="mb-3">
                <label for="id_cliente" class="form-label">Id cliente</label>
                <input type="number" class="form-control" name="id_cliente">
               
            </div>

            <div class="mb-3">
                <label for="nombre" class="form-label">Fecha de alta nueva cuenta</label>
                <input type="date" class="form-control" name="fecha_alta">
            </div>

          
            <div class="mb-3">
                <label for="saldo" class="form-label">Saldo inicial</label>
                <input type="number" class="form-control" name="saldo" min="0" step="0.01">
            </div>


           
            <a class="btn btn-secondary" href="<?= URL ?>cuenta" role="button">Cancelar</a>
            <button type="reset" class="btn btn-danger" >Borrar</button>
            <button type="submit" class="btn btn-primary" >Enviar</button>

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