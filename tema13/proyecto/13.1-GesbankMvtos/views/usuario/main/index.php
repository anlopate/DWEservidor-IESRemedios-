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
		<?php require_once("views/usuario/partials/header.php") ?>
		<!-- Mensajes -->
		<?php require_once("template/partials/notify.php") ?>
		<!-- Errores -->
		<?php require_once("template/partials/error.php") ?>
		<!-- Estilo card bootstrap -->
		<div class="card">
			<div class="card-header">
				Tabla Usuarios
			</div>
			</div>
			
			<div class="card-header">
				<!-- Menú clientes -->
				<?php require_once("views/usuario/partials/menu.php") ?>
			</div>
			<div class="card-body">
				<table class="table">
					<thead>
						<tr>
							<th scope="col">Id</th>
							<th scope="col">Nombre</th>
							<th scope="col">Email</th>
							<th scope="col">Password</th>
						</tr>
					</thead>
					
					<tbody>
						<?php foreach ($this->usuarios as $usuario): ?>
							<tr>
								<th>
									<?= $usuario->id ?>
								</th>
								<td>
									<?= $usuario->name ?>
								</td>
								<td>
									<?= $usuario->email ?>
								</td>
								<!-- <td>
								
								</td> -->
								
								
									
								<!-- botones de acción -->
								<td style="display:flex; justify-content:space-between;">
									<!-- botón  eliminar -->
									<a href="<?= URL ?>usuario/delete/<?= $usuario->id ?>" title="Eliminar" onclick="return confirm('Confimar elimación de cliente.')" class="btn btn-danger
											<?= (!in_array($_SESSION['id_rol'], $GLOBALS['usuario']['delete'])) ?
												'disabled' : null ?>">
										<i class="bi bi-trash"></i></a>

									<!-- botón  editar -->
									<a href="<?= URL ?>usuario/edit/<?= $usuario->id ?>" title="Editar" class="btn btn-primary
											<?= (!in_array($_SESSION['id_rol'], $GLOBALS['usuario']['edit']))?
												'disabled' : null ?>">
											<i class="bi bi-pencil"></i>
										</a>

									<!-- botón  mostrar -->
									<a href="<?= URL ?>usuario/show/<?= $usuario->id ?> ?>" title="Mostrar" class="btn btn-warning
											<?= (!in_array($_SESSION['id_rol'], $GLOBALS['usuario']['show'])) ?
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
				<small class="text-muted">Número de Usuarios: <?= $this->usuarios->rowCount() ?></small>
		</div>
	</div>
	<br><br><br>
	<?php require_once("template/partials/footer.php") ?>
	<?php require_once("template/partials/javascript.php") ?>

</body>

</html>