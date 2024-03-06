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
				Tabla Movimientos
			</div>
			</div>
			
			<div class="card-header">
				<!-- Menú clientes -->
				<?php require_once("views/movimientos/partials/menu.php") ?>
			</div>
			<div class="card-body">
				<table class="table">
					<thead>
						<tr>
							<th scope="col">Id</th>
							<th scope="col">Id Cuenta</th>
							<th scope="col">Fecha/hora</th>
							<th scope="col">Concepto</th>
							<th scope="col">Tipo</th>
							<th scope="col">Cantidad</th>
							<th scope="col">Saldo</th>
					</thead>
					
					<tbody>
						<?php foreach ($this->movimientos as $mvto): ?>
							<tr>
								<th>
									<?= $mvto->id ?>
								</th>
								<td>
									<?= $mvto->id_cuenta ?>
								</td>
								<td>
									<?= $mvto->fecha_hora?>
								</td>
								<td>
									<?= $mvto->concepto ?>
								</td>
								<td>
									<?= $mvto->tipo ?>
								</td>
								<td>
									<?= $mvto->cantidad ?>
								</td>
								<td>
									<?= $mvto->saldo ?>
								</td>
									
								<!-- botones de acción -->
								<td style="display:flex; justify-content:space-between;">
									<!-- botón  mostrar -->
									<a href="<?= URL ?>movimientos/show/<?= $mvto->id ?> ?>" title="Mostrar" class="btn btn-warning
											<?= (!in_array($_SESSION['id_rol'], $GLOBALS['movimientos']['show'])) ?
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
				<small class="text-muted">Número de Movimientos: <?= $this->movimientos->rowCount() ?></small>
			

		</div>
	</div>
	<br><br><br>
	

	<?php require_once("template/partials/footer.php") ?>
	<?php require_once("template/partials/javascript.php") ?>

</body>

</html>