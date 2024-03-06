<!doctype html>
<html lang="es">

<head>
<?php require_once("template/partials/head.php") ?>
<title><?=$this->title?></title>
</head>

<body>
	<!-- Menú principal -->
	<?php require_once("template/partials/menuAut.php")?>
	<br><br><br>
	<!-- Page Content -->
	<div class="container">
		<!-- Cabecera -->
		<?php require_once("views/cliente/partials/header.php") ?>
		<!-- Mensajes -->
		<?php require_once("template/partials/notify.php") ?>
		<!-- Errores -->
		<?php require_once("template/partials/error.php") ?>
		<!-- Estilo card bootstrap -->
		<div class="card">
			<div class="card-header">
				Tabla Clientes
			</div>
			</div>
			
			<div class="card-header">
				<!-- Menú clientes -->
				<?php require_once("views/cliente/partials/menu.php") ?>
			</div>
			<div class="card-body">
				<table class="table">
					<thead>
						<tr>
							<th scope="col">Id</th>
							<th scope="col">Cliente</th>
							<th scope="col">Telefono</th>
							<th scope="col">Ciudad</th>
							<th scope="col">DNI</th>
							<th scope="col">Email</th>
							<th scope="col">Acciones</th>
						</tr>
					</thead>
					
					<tbody>
						<?php foreach ($this->clientes as $cliente): ?>
							<tr>
								<th>
									<?= $cliente->id ?>
								</th>
								<td>
									<?= $cliente->cliente ?>
								</td>
								<td>
									<?= $cliente->telefono ?>
								</td>
								<td>
									<?= $cliente->ciudad ?>
								</td>
								<td>
									<?= $cliente->dni ?>
								</td>
								<td>
									<?= $cliente->email ?>
								</td>
								
									
								<!-- botones de acción -->
								<td style="display:flex; justify-content:space-between;">
									<!-- botón  eliminar -->
									<a href="<?= URL ?>cliente/delete/<?= $cliente->id ?>" title="Eliminar" onclick="return confirm('Confimar elimación de cliente.')" class="btn btn-danger
											<?= (!in_array($_SESSION['id_rol'], $GLOBALS['cliente']['delete'])) ?
												'disabled' : null ?>">
										<i class="bi bi-trash"></i></a>

									<!-- botón  editar -->
									<a href="<?= URL ?>cliente/edit/<?= $cliente->id ?>" title="Editar" class="btn btn-primary
											<?= (!in_array($_SESSION['id_rol'], $GLOBALS['cliente']['edit']))?
												'disabled' : null ?>">
											<i class="bi bi-pencil"></i>
										</a>

									<!-- botón  mostrar -->
									<a href="<?= URL ?>cliente/show/<?= $cliente->id ?> ?>" title="Mostrar" class="btn btn-warning
											<?= (!in_array($_SESSION['id_rol'], $GLOBALS['cliente']['show'])) ?
												'disabled' : null ?>">
											<i class="bi bi-card-text"></i>
										</a>
								
								</td>

							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<div class="card-footer">
				<small class="text-muted">Número de Clientes: <?= $this->clientes->rowCount() ?></small>
			

		</div>
	</div>
	<br><br><br>
	

	<?php require_once("template/partials/footer.php") ?>
	<?php require_once("template/partials/javascript.php") ?>

</body>

</html>