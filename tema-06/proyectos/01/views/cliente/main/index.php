<!doctype html>
<html lang="es">

<head>
<?php require_once("template/partials/head.php") ?>
<title><?=$this->title?></title>
</head>

<body>
	<?php require_once("template/partials/menu.php")?>
	<br><br><br>
	<div class="container">
		<?php require_once("views/cliente/partials/header.php") ?>
		<?php require_once("template/partials/mensaje.php") ?>
		<?php require_once("template/partials/error.php") ?>

		<div class="card">
			<div class="card-header">
				Tabla Clientes
			</div>
			<div class="card-header">
				<?php require_once("views/cliente/partials/menu.php") ?>
			</div>
			<div class="card-body">
				
				<table class="table">
					<thead>
						<tr>
							<th scope="col">Id</th>
							<th scope="col">Nombre</th>
							<th scope="col">Apellidos</th>
							<th scope="col">Email</th>
							<th scope="col">Telefono</th>
							<th scope="col">Ciudad</th>
							<th scope="col">DNI</th>
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
									<?= $cliente->nombre ?>
								</td>
								<td>
									<?= $cliente->apellidos ?>
								</td>
								<td>
									<?= $cliente->email ?>
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
									<!-- Botón eliminar -->
									<a href="<?=URL?>cliente/delete/<?= $cliente->id ?>" title="Eliminar">
										<i class="bi bi-trash-fill">Delete</i>
									</a>

									<!-- Botón editar -->
									<a href="<?=URL?>cliente/edit/<?= $cliente->id ?>" title="Editar">
										<i class="bi bi-pencil-square">Edit</i>
									</a>
									<!-- Botón mostrar -->
									<a href="<?=URL?>cliente/show/<?= $cliente->id ?>" title="Mostrar">
										<i class="bi bi-tv">Show</i>
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


	</div>
	<br><br><br>
	

	<?php require_once("template/partials/footer.php") ?>
	<?php require_once("template/partials/javascript.php") ?>

</body>

</html>