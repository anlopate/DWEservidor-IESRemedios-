<!doctype html>
<html lang="es">

<!-- head -->

<head>
	<?php require_once("template/partials/head.php") ?>
	<title>
		<?= $this->title ?>
	</title>

	<head>


	<body>
		<!-- Menú Principal -->
		<?php require_once("template/partials/menuAut.php") ?>
		<br><br><br>

		<!-- Page Content -->
		<div class="container">
			<!-- cabecera  -->
			<?php require_once("views/album/partials/header.php") ?>

			<!-- mensajes -->
			<?php require_once("template/partials/notify.php") ?>

			<!-- errores -->
			<?php require_once("template/partials/error.php") ?>



			<!-- Estilo card de bootstrap -->
			<div class="card">
				<div class="card-header">
					Tabla Albumes
				</div>
				<div class="card-header">
					<!-- menu albumes -->
					<?php require_once("views/album/partials/menu.php") ?>
				</div>
				<div class="card-body">

					<!-- Muestra datos de la tabla -->
					<table class="table">
						<!-- Encabezado tabla -->
						<thead>
							<tr>
								<!-- personalizado -->
								<th>Id</th>
								<th>Título</th>
								<th>Lugar</th>
								<th>Categoría</th>
								<th>Etiquetas</th>
								<th>Num_fotos</th>
								<th>Num_visitas</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<!-- Mostramos cuerpo de la tabla -->
						<tbody>

							<!-- Objeto clase pdostatement en foreach -->
							<?php foreach ($this->albumes as $album): ?>
								<tr>
									<!-- Formatos distintos para cada  columna -->

									<!-- Detalles de album -->
									<td><?= $album->id ?></td>
									<td><?= $album->titulo ?></td>
									<td><?= $album->lugar ?></td>
									<td><?= $album->categoria ?></td>
									<td><?= $album->etiquetas ?></td>
									<td><?= $album->num_fotos ?></td>
									<td><?= $album->num_visitas ?></td>
									
									
									<!-- botones de acción -->
									<td>
										<!-- botón  eliminar -->
										<a href="<?= URL ?>album/delete/<?= $album->id ?>" title="Eliminar"
											onclick="return confirm('Confimar elimación album')" class="btn btn-danger
											<?= (!in_array($_SESSION['id_rol'], $GLOBALS['album']['delete'])) ?
												'disabled' : null ?>">
											<i class="bi bi-trash"></i>
										</a>

										<!-- botón  editar -->
										<a href="<?= URL ?>album/edit/<?= $album->id ?>" title="Editar" class="btn btn-primary
											<?= (!in_array($_SESSION['id_rol'], $GLOBALS['album']['edit']))?
												'disabled' : null ?>">
											<i class="bi bi-pencil"></i>
										</a>

										<!-- botón  mostrar -->
										<a href="<?= URL ?>album/show/<?= $album->id ?>" title="Mostrar" class="btn btn-warning
											<?= (!in_array($_SESSION['id_rol'], $GLOBALS['album']['show'])) ?
												'disabled' : null ?>">
											<i class="bi bi-card-text"></i>
										</a>
										<!-- boton subir imágenes-->
										<a href="<?=URL ?>album/subir/<?= $album->id ?>"title="Subir" data-bs-tooggle="modal">
											<i class="bi bi-cloud-upload-fill"></i>
										</a>

									</td>
								</tr>

							<?php endforeach; ?>
						</tbody>

					</table>

				</div>
				<div class="card-footer">
					<small class="text-muted"> Nº Albumes:
						<?= $this->albumes->rowCount(); ?>
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