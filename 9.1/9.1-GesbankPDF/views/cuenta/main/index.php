<!doctype html>
<html lang="es">

<!-- head -->
<head>
	<?php require_once("template/partials/head.php") ?>
	
</head>

<body>
	<?php require_once("template/partials/menuAut.php") ?>
	<br><br><br>
	<div class="container">
		<?php require_once("views/cuenta/partials/header.php") ?>
		<?php require_once("template/partials/mensaje.php") ?>
		<?php require_once("template/partials/error.php") ?>

		<div class="card" >
			<div class="card-header">
				Tabla Cuentas
			</div>
			<div class="card-header">
				<?php require_once("views/cuenta/partials/menu.php") ?>
			</div>
			<div class="card-body">
				<table class="table">
					<thead>
						<tr>
							<th scope="col">Id</th>
							<th scope="col">Número de cuenta</th>
							<th scope="col">Cliente</th>
							<th scope="col">Fecha de alta</th>
							<th scope="col">Fecha ultimo movto</th>
							<th scope="col">Nº movimientos</th>
							<th scope="col">Saldo</th>
							<th scope="col">Acciones</th>
						</tr>
					</thead>
					
					<tbody>
						<?php foreach ($this->cuentas as $cuenta): ?>
							<tr>
								
								<th>
									<?= $cuenta->id ?>
								</th>
								<td>
									<?= $cuenta->num_cuenta ?>
								</td>
								<td>
									<?= $cuenta->cliente?>
								</td>
								<td>
									<?= $cuenta->fecha_alta?>
								</td>
								<td>
									<?= $cuenta->fecha_ul_mov ?>
								</td>
								<td class ="text-end">
									<?=  number_format($cuenta->num_movtos,0,',',',') ?>
								</td>
								<td class ="text-end">
									<?=  number_format($cuenta->saldo,2,',',',') ?> €
								</td>
									<!-- botones de acción -->
									<td style="display:flex; justify-content:space-between;">
									<!-- botón  eliminar -->
									<a href="<?= URL ?>cuenta/delete/<?= $cuenta->id ?>" title="Eliminar" onclick="return confirm('Confimar elimación de cuenta.')" class="btn btn-danger
											<?= (!in_array($_SESSION['id_rol'], $GLOBALS['cuenta']['delete'])) ?
												'disabled' : null ?>">
										<i class="bi bi-trash"></i></a>

									<!-- botón  editar -->
									<a href="<?= URL ?>cuenta/edit/<?= $cuenta->id ?>" title="Editar" class="btn btn-primary
											<?= (!in_array($_SESSION['id_rol'], $GLOBALS['cuenta']['edit']))?
												'disabled' : null ?>">
											<i class="bi bi-pencil"></i>
										</a>

									<!-- botón  mostrar -->
									<a href="<?= URL ?>cuenta/show/<?= $cuenta->id ?> ?>" title="Mostrar" class="btn btn-warning
											<?= (!in_array($_SESSION['id_rol'], $GLOBALS['cuenta']['show'])) ?
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
				<small class="text-muted"> Nº Cuentas: 
					<?= $this->cuentas->rowCount(); ?>
				</small>
			</div>
		</div>
	</div>
	<br><br><br>

	<!-- /.container -->

	<?php require_once("template/partials/footer.php") ?>
	<?php require_once("template/partials/javascript.php") ?>

</body>

</html>