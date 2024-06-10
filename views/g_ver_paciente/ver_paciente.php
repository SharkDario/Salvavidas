<?php
require "../../controllers/controlador_ver_paciente_2.php";
?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<meta http-equiv="x-ua-compatible" content="IE=edge">
	<meta name="author" content="Miguel Dario Coronel">
	<meta name="description" content="Bootstrap Template by Canvas">

	<!-- Font Imports -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=JetBrains Mono:wght@300;400;500;600;700&display=swap" />
	<script src="https://cdn.tailwindcss.com"></script>
	<link rel="stylesheet" href="../index.css" />

	<!-- Core Style -->
	<link rel="stylesheet" href="style.css">

	<!-- Font Icons -->
	<link rel="stylesheet" href="css/font-icons.css">

	<!-- Plugins/Components CSS -->
	<link rel="stylesheet" href="css/components/bs-datatable.css">
	<link rel="icon" href="./public/group-1686550876.svg">

	<!-- Custom CSS -->
	<link rel="stylesheet" href="css/custom.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Document Title
	============================================= -->
	<title>Salvavidas | Paciente</title>

</head>

<body class="stretched" data-menu-breakpoint="1200" >

	<div id="wrapper" class="bg-gradient-to-br from-orange-500 to-orange-700">
		<!-- Content================================ -->
		<section id="content" class="bg-gradient-to-br from-orange-300 to-orange-500 rounded-3xl shadow-lg p-8 max-w-6xl w-full mx-auto">
			<div class="content-wrap">
				<div class="container">
					<h1 class="aplicacion-salvavidas-2 animate-pulse">Paciente <?php echo $nombre_completo; ?> </h1>

					<div class="form-widget">

						<div class="form-result"></div>

						<div class="row">
							<div class="col-lg-6">
								<form class="row" action="include/form.php" method="post" enctype="multipart/form-data">
									<div class="form-process">
										<div class="css3-spinner">
											<div class="css3-spinner-scaler"></div>
										</div>
									</div>

									<div class="col-12 form-group">
										<div class="row">
											<div class="w-100"></div>
											<div class="col-md-6 form-group">
												<label>DNI:</label>
												<input type="number" name="dni" id="dni" class="form-control required" value="<?php echo $dni; ?>" placeholder="DNI">
											</div>
											<div class="col-md-6 form-group">
												<label>Nombre:</label>
												<input type="text" name="nombre" id="nombre" class="form-control required" value="<?php echo $nombre; ?>" placeholder="Nombre">
											</div>
											<div class="col-md-6 form-group">
												<label>Apellido:</label>
												<input type="text" name="apellido" id="apellido" class="form-control required" value="<?php echo $apellido; ?>" placeholder="Apellido">
											</div>
											<div class="col-md-6 form-group">
												<label>Fecha de nacimiento:</label>
												<input type="date" class="form-control dobpicker required" name="fecha_nacimiento" id="fecha_nacimiento" value="<?php echo $fecha_nacimiento; ?>" placeholder="MM/DD/YYYY" data-date-end-date="-18y">
											</div>
										</div>
										<div class="row">
											<div class="w-100"></div>
											<div class="col-md-6 form-group">
												<label>Estatura:</label>
												<input type="number" step="0.01" name="estatura" id="estatura" class="form-control required" value="<?php echo $estatura; ?>" placeholder="Estatura">
											</div>
											<div class="col-md-6 form-group">
												<label>Peso:</label>
												<input type="number" step="0.01" name="peso" id="peso" class="form-control required" value="<?php echo $peso; ?>" placeholder="Peso">
											</div>
										</div>
										<div class="row">
											<div class="w-100"></div>
											
											<div class="col-md-6 form-group">
												<label>Sexo:</label>
												<div class="btn-group d-flex" data-bs-toggle="buttons">
													<input type="radio" class="btn-check" name="sexo" id="sexo-male" value="hombre" <?php if ($sexo === 'hombre') echo 'checked'; ?>>
													<label class="btn btn-outline-secondary text-transform-none ls-0" for="sexo-male">Hombre</label>

													<input type="radio" class="btn-check" name="sexo" id="sexo-female" value="mujer" <?php if ($sexo === 'mujer') echo 'checked'; ?>>
													<label class="btn btn-outline-secondary text-transform-none ls-0" for="sexo-female">Mujer</label>
												</div>
											</div>
											<div class="col-md-6 form-group">
												<label>Tipo de sangre:</label>
												<select class="form-select required" name="tipo_sangre" id="tipo_sangre">
													<option value="">-- Selecciona Uno --</option>
													<option value="O+" <?php if ($tipo_sangre === 'O+') echo 'selected'; ?>>O+</option>
													<option value="O-" <?php if ($tipo_sangre === 'O-') echo 'selected'; ?>>O-</option>
													<option value="A+" <?php if ($tipo_sangre === 'A+') echo 'selected'; ?>>A+</option>
													<option value="A-" <?php if ($tipo_sangre === 'A-') echo 'selected'; ?>>A-</option>
													<option value="B+" <?php if ($tipo_sangre === 'B+') echo 'selected'; ?>>B+</option>
													<option value="B-" <?php if ($tipo_sangre === 'B-') echo 'selected'; ?>>B-</option>
													<option value="AB+" <?php if ($tipo_sangre === 'AB+') echo 'selected'; ?>>AB+</option>
													<option value="AB-" <?php if ($tipo_sangre === 'AB-') echo 'selected'; ?>>AB-</option>
												</select>
											</div>
											<div class="col-md-6 form-group">
												<label>Fecha de ingreso:</label>
												<input type="datetime-local" class="form-control dobpicker required" name="fecha_alta" id="fecha_alta" value="<?php echo $fecha_alta; ?>" placeholder="MM/DD/YYYY" data-date-end-date="-18y" readonly disabled>
											</div>
											<div class="col-md-6 form-group">
												<label>Descripción:</label>
												<textarea name="descripcion_alta" id="descripcion_alta" class="form-control required" placeholder="Descripción" readonly disabled><?php echo $descripcion_alta; ?></textarea>
											</div>
											<div class="col-md-6 form-group">
												<label>Fecha de egreso:</label>
												<input type="datetime-local" class="form-control dobpicker required" name="fecha_baja" id="fecha_baja" value="<?php echo $fecha_baja; ?>" placeholder="MM/DD/YYYY" data-date-end-date="-18y" readonly disabled>
											</div>
											<div class="col-md-6 form-group">
												<label>Descripción:</label>
												<textarea name="descripcion_baja" id="descripcion_baja" class="form-control required" placeholder="Descripción" readonly disabled><?php echo $descripcion_baja; ?></textarea>
											</div>
										</div>
									</div>
								</form>
							</div>
							<div class="col-lg-6 ps-lg-6">
								<img src="data:image/svg+xml;base64,<?php echo $base64; ?>" width="400px">
								<button class="button_1" style="font-size: 20px; width: 380px; margin-top: 20px; margin-bottom: 20px" id="modificar_paciente" name="modificar_paciente" type="submit">
									<span class="span_1">MODIFICAR PACIENTE</span>
								</button>
								<button class="button_1" style="font-size: 20px; width: 380px;" id="annadir_ficha" name="annadir_ficha" type="submit">
									<span class="span_1">AÑADIR FICHA MÉDICA</span>
								</button>
							</div>
						</div>
					</div>
					<div>
						<br>
						<?php if ($fecha_baja==""): ?>
						<h2 class="aplicacion-salvavidas-3">¿Egresa de terapia intensiva?</h2>
						<div class="row">
							<div class="col-lg-6">
								<div class="col-md-12 form-group">
									<label>Fecha de egreso:</label>
									<input type="datetime-local" class="form-control dobpicker required" name="fecha_baja_mod" id="fecha_baja_mod" placeholder="MM/DD/YYYY" data-date-end-date="-18y" required>
									<label>Descripción:</label>
									<textarea name="descripcion_baja_mod" id="descripcion_baja_mod" class="form-control required" placeholder="Descripción" required></textarea>
								</div>
							</div>
							<div class="col-lg-6 ps-lg-6">
								<button class="button_1" style="font-size: 20px; width: 380px;" id="egresa" name="egresa" type="submit">
									<span class="span_1">CONFIRMAR</span>
								</button>
							</div>
						</div>
						<?php else: ?>
						<h2 class="aplicacion-salvavidas-3">¿Ingresa otra vez a terapia intensiva?</h2>
						<div class="row">
							<div class="col-lg-6">
								<div class="col-md-6 form-group">
									<label>Fecha de ingreso:</label>
									<input type="datetime-local" class="form-control dobpicker required" name="fecha_alta_mod" id="fecha_alta_mod" placeholder="MM/DD/YYYY" data-date-end-date="-18y" required>
									<label>Descripción:</label>
									<textarea name="descripcion_alta_mod" id="descripcion_alta_mod" class="form-control required" placeholder="Descripción" required></textarea>
								</div>
							</div>
							<div class="col-lg-6 ps-lg-6">
								<button class="button_1" style="font-size: 20px; width: 380px;" id="ingresa" name="ingresa" type="submit">
									<span class="span_1">CONFIRMAR</span>
								</button>
							</div>
						</div>
						<?php endif; ?>
					</div>
					<!-- Datos que se pueden modificar -->
					<!-- Domicilios -->
					<br>
					<div class="table-responsive">
						<h2 class="aplicacion-salvavidas-3">Domicilios</h2>
						<table id="datatable7" class="table table-striped table-bordered" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Calle</th>
									<th>Número</th>
									<th>Ciudad</th>
									<th>País</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>Calle</th>
									<th>Número</th>
									<th>Ciudad</th>
									<th>País</th>
								</tr>
							</tfoot>
							<tbody>
								<tr>
									<td>Tiger Nixon</td>
									<td>0001</td>
									<td>Monterrey</td>
									<td>México</td>
								</tr>
							</tbody>
						</table>
					</div>
					<br />
					<!-- Contactos -->
					<div class="table-responsive">
						<h2 class="aplicacion-salvavidas-3">Contactos</h2>
						<table id="datatable8" class="table table-striped table-bordered" cellspacing="0" width="100%">

							<thead>
								<tr>
									<th>Tipo</th>
									<th>Medio</th>
									<th>Valor</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>Tipo</th>
									<th>Medio</th>
									<th>Valor</th>
								</tr>
							</tfoot>
							<tbody>
								<tr>
									<td>Tiger Nixon</td>
									<td>0</td>
									<td>0</td>
								</tr>
							</tbody>
						</table>
					</div>
					<br />

					<br />
					<h1 class="aplicacion-salvavidas-3">Historia Clínica Actual</h1>

					<!-- Tratamientos actuales -->
					<div class="table-responsive">
						<h2 class="aplicacion-salvavidas-3">Tratamientos actuales</h2>
						<table id="datatable1" class="table table-striped table-bordered" cellspacing="0" width="100%">

							<thead>
								<tr>
									<th>Tipo</th>
									<th>Nombre</th>
									<th>Fecha de inicio</th>
									<th>Descripción</th>
									<th>Ver medicamentos</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>Tipo</th>
									<th>Nombre</th>
									<th>Fecha de inicio</th>
									<th>Descripción</th>
									<th>Ver medicamentos</th>
								</tr>
							</tfoot>
							<tbody>
								<tr>
									<td>Cirugía</td>
									<td>Gastrectomía</td>
									<td>7/5/2024</td>
									<td>Extirpar tejidos cercanos al tumor</td>
									<td><button>Ver 0 medicamentos</button></td>
								</tr>
							</tbody>
						</table>
					</div>
					<br />
					<!-- Enfermedades actuales -->
					<div class="table-responsive">
						<h2 class="aplicacion-salvavidas-3">Enfermedades actuales</h2>
						<table id="datatable2" class="table table-striped table-bordered" cellspacing="0" width="100%">

							<thead>
								<tr>
									<th>Tipo</th>
									<th>Nombre</th>
									<th>Fecha de inicio</th>
									<th>Descripción</th>
									<th>Nivel de gravedad</th>
									<th>Ver síntomas</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>Tipo</th>
									<th>Nombre</th>
									<th>Fecha de inicio</th>
									<th>Descripción</th>
									<th>Nivel de gravedad</th>
									<th>Ver síntomas</th>
								</tr>
							</tfoot>
							<tbody>
								<tr>
									<td>Tumores</td>
									<td>Cáncer de estómago</td>
									<td>5/5/2024</td>
									<td>...</td>
									<td>Grave</td>
									<td><button>Ver 7 síntomas</button></td>
								</tr>
							</tbody>
						</table>
					</div>
					<br />
					<!-- Antecedentes -->
					<div class="table-responsive">
						<h2 class="aplicacion-salvavidas-3">Antecedentes</h2>
						<table id="datatable3" class="table table-striped table-bordered" cellspacing="0" width="100%">

							<thead>
								<tr>
									<th>Tipo</th>
									<th>Nombre</th>
									<th>Frecuencia</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>Tipo</th>
									<th>Nombre</th>
									<th>Frecuencia</th>
								</tr>
							</tfoot>
							<tbody>
								<tr>
									<td>Tiger Nixon</td>
									<td>0</td>
									<td>Edinburgh</td>
								</tr>
							</tbody>
						</table>
					</div>
					<br />
					<!-- Seguimientos -->
					<div class="table-responsive">
						<h2 class="aplicacion-salvavidas-3">Seguimientos</h2>
						<table id="datatable4" class="table table-striped table-bordered" cellspacing="0" width="100%">

							<thead>
								<tr>
									<th>Mátricula Enfermera/o</th>
									<th>Fecha de inicio</th>
									<th>Fecha de fin</th>
									<th>Descripción</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>Mátricula Enfermera/o</th>
									<th>Fecha de inicio</th>
									<th>Fecha de fin</th>
									<th>Descripción</th>
								</tr>
							</tfoot>
							<tbody>
								<tr>
									<td>Tiger Nixon</td>
									<td>0</td>
									<td>Edinburgh</td>
									<td>Edinburgh</td>
								</tr>
							</tbody>
						</table>
					</div>
					<br />
					<!-- Tratamientos finalizados -->
					<div class="table-responsive">
						<h2 class="aplicacion-salvavidas-3">Tratamientos finalizados</h2>
						<table id="datatable5" class="table table-striped table-bordered" cellspacing="0" width="100%">

							<thead>
								<tr>
									<th>Tipo</th>
									<th>Nombre</th>
									<th>Fecha de inicio</th>
									<th>Descripción</th>
									<th>Fecha de fin</th>
									<th>Resultado</th>
									<th>Ver medicamentos</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>Tipo</th>
									<th>Nombre</th>
									<th>Fecha de inicio</th>
									<th>Descripción</th>
									<th>Fecha de fin</th>
									<th>Resultado</th>
									<th>Ver medicamentos</th>
								</tr>
							</tfoot>
							<tbody>
								<tr>
									<td>Tiger Nixon</td>
									<td>0</td>
									<td>Edinburgh</td>
									<td>61</td>
									<td>Edinburgh</td>
									<td>61</td>
									<td><button>Ver 7 medicamentos</button></td>
								</tr>
							</tbody>
						</table>
					</div>
					<br />
					<!-- Enfermedades finalizadas -->
					<div class="table-responsive">
						<h2 class="aplicacion-salvavidas-3">Enfermedades finalizadas</h2>
						<table id="datatable6" class="table table-striped table-bordered" cellspacing="0" width="100%">

							<thead>
								<tr>
									<th>Tipo</th>
									<th>Nombre</th>
									<th>Fecha de inicio</th>
									<th>Descripción</th>
									<th>Nivel de gravedad</th>
									<th>Fecha de fin</th>
									<th>Resultado</th>
									<th>Ver síntomas</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>Tipo</th>
									<th>Nombre</th>
									<th>Fecha de inicio</th>
									<th>Descripción</th>
									<th>Nivel de gravedad</th>
									<th>Fecha de fin</th>
									<th>Resultado</th>
									<th>Ver síntomas</th>
								</tr>
							</tfoot>
							<tbody>
								<tr>
									<td>Tiger Nixon</td>
									<td>0</td>
									<td>Edinburgh</td>
									<td>61</td>
									<td>2011/04/25</td>
									<td>2011/04/25</td>
									<td>Edinburgh</td>
									<td><button>Ver 7 síntomas</button></td>
								</tr>
							</tbody>
						</table>
					</div>
					<br />

					<br />
					<h1 class="aplicacion-salvavidas-3">Historia Clínica Completa</h1>
					<!-- Fichas médicas -->
					<div class="table-responsive">
						<h2 class="aplicacion-salvavidas-3">Fichas médicas</h2>
						<table id="datatable9" class="table table-striped table-bordered" cellspacing="0" width="100%">

							<thead>
								<tr>
									<th>Matrícula Médica/o</th>
									<th>Especialidad</th>
									<th>Fecha</th>
									<th>Cant. Tratamientos</th>
									<th>Cant. Enfermedades</th>
									<th>Cant. Antecedentes</th>
									<th>Ver ficha</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>Matrícula Médica/o</th>
									<th>Especialidad</th>
									<th>Fecha</th>
									<th>Cant. Tratamientos</th>
									<th>Cant. Enfermedades</th>
									<th>Cant. Antecedentes</th>
									<th>Ver ficha</th>
								</tr>
							</tfoot>
							<tbody>
								<tr>
									<td>Tiger Nixon</td>
									<td>0</td>
									<td>Edinburgh</td>
									<td>61</td>
									<td>2011/04/25</td>
									<td>2011/04/25</td>
									<td><button>Ver detalles</button></td>
								</tr>
							</tbody>
						</table>
					</div>
					<br/>
				</div>

			</div>
		</section><!-- #content end -->
	</div><!-- #wrapper end -->
	
	<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="uil uil-angle-up"></div>

	<!-- JavaScripts
	============================================= -->
	<script src="js/jquery.js"></script>
	<script src="js/functions.js"></script>

	<!-- Bootstrap Data Table Plugin -->
	<script src="js/components/bs-datatable.js"></script>

	<script>
		jQuery(document).ready(function() {
			jQuery('#datatable1').dataTable();
			jQuery('#datatable2').dataTable();
            jQuery('#datatable3').dataTable();
			jQuery('#datatable4').dataTable();
			jQuery('#datatable5').dataTable();
			jQuery('#datatable6').dataTable();
			jQuery('#datatable7').dataTable();
			jQuery('#datatable8').dataTable();
            jQuery('#datatable9').dataTable();
		});
	</script>

</body>
</html>