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
	
	<!-- Core Style -->
	<link rel="stylesheet" href="style.css?v=1.0">
	
	<script src="https://cdn.tailwindcss.com"></script>
	<link rel="stylesheet" href="../index.css" />

	<!-- Font Icons -->
	<link rel="stylesheet" href="css/font-icons.css">

	<!-- Plugins/Components CSS -->
	<link rel="stylesheet" href="css/components/bs-datatable.css">
	<link rel="icon" href="./public/group-1686550876.svg">

	<!-- Custom CSS -->
	<link rel="stylesheet" href="css/custom.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- script de SweetAlert2 -->
    <script src="https://unpkg.com/sweetalert2@9.5.3/dist/sweetalert2.all.min.js"></script>

	<!-- script para generar Excel -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.4/xlsx.full.min.js"></script>

	<!-- Document Title
	============================================= -->
	<title>Salvavidas | Paciente</title>
	<style>
		.button_1 {
			font-size: 10px;
			width: 160px;
		}
	</style>
</head>

<body class="stretched" data-menu-breakpoint="1200" >
	<div id="loader_corazon" class="loader_corazon"></div>
	<div id="wrapper" class="bg-gradient-to-br from-orange-500 to-orange-700">
		<!-- Content================================ -->
		<section id="content" class="bg-gradient-to-br from-orange-300 to-orange-500 rounded-3xl shadow-lg p-8 max-w-6xl w-full mx-auto">
			
			<div class="content-wrap">
				
				<div class="container">
					
					<h1 class="aplicacion-salvavidas-2 animate-pulse">Paciente <?php echo $nombre_completo; ?> </h1>
					
					<?php if (isset($_GET['mensaje'])): $mensaje = htmlspecialchars_decode($_GET['mensaje'], ENT_QUOTES);?>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Actualización',
                                confirmButtonText: "OK",
                                confirmButtonColor: "#D05F1F",
                                html: '<?php echo $mensaje; ?>'
                            });
                        });
                    </script>
                	<?php endif; ?>
					<div class="form-widget">

						<div class="form-result"></div>

						<div class="row">
							<form class="row" action="../../controllers/controlador_ver_paciente_3.php" method="post" enctype="multipart/form-data">
								
								<input type="hidden" id="paciente_objeto" name="paciente_objeto" value="<?php $paciente_objeto?>">
								<input type="hidden" id="paciente_id" name="paciente_id" value="<?php echo $_GET['id']; ?>">
								<input type="hidden" id="nombre_usuario" name="nombre_usuario" value="<?php echo $_SESSION['nombre_usuario']?>">
								<input type="hidden" id="usuario_objeto" name="usuario_objeto" value="<?php $usuario_objeto?>">
								<input type="hidden" id="usuario_puesto" name="usuario_puesto" value="<?php $usuario_puesto?>">
							
								<div class="col-lg-6">
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
												<label>Estatura (m):</label>
												<input type="number" step="0.01" name="estatura" id="estatura" class="form-control required" value="<?php echo $estatura; ?>" placeholder="Estatura">
											</div>
											<div class="col-md-6 form-group">
												<label>Peso (kg):</label>
												<input type="number" step="0.01" name="peso" id="peso" class="form-control required" value="<?php echo $peso; ?>" placeholder="Peso">
											</div>
										</div>
										<div class="row">
											<div class="w-100"></div>
											<div class="col-md-6 form-group">
												<label>Edad:</label>
												<input type="number" name="edad" id="edad" class="form-control required" value="<?php echo $edad; ?>" readonly disabled>
											</div>
											<div class="col-md-6 form-group">
												<label>IMC:</label>
												<input type="number" step="0.01" name="imc" id="imc" class="form-control required" value="<?php echo $imc; ?>" readonly disabled>
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
								
								</div>
								<div class="col-lg-6 ps-lg-6">
									<button type="button" class="animate-pulse" onclick="exportToExcel()" style="background-image: url('public/excel_img.png'); background-size: contain; background-repeat: no-repeat; width: 400px; height: 70px; margin-left: 300px"></button>
									<br>
									
									<img src="data:image/svg+xml;base64,<?php echo $base64; ?>" width=400>
									<br>
									
									<?php if ($fecha_baja=="" && $usuario_puesto != "Enfermero"): ?>
									<button class="button_1" style="font-size: 20px; width: 350px; margin-top: 20px; margin-bottom: 20px; margin-left: 20px" id="modificar_paciente" name="modificar_paciente" type="submit">
										<span class="span_1">MODIFICAR PACIENTE</span>
									</button>
									<button class="button_1" style="font-size: 20px; width: 350px; margin-left: 20px" id="annadir_ficha" name="annadir_ficha" type="submit">
										<span class="span_1">AÑADIR FICHA MÉDICA</span>
									</button>
									<?php elseif ($fecha_baja == ""): ?>
									<br>
									<button class="button_1" style="font-size: 20px; width: 350px; margin-left: 20px" id="annadir_seg" name="annadir_seg" type="submit">
										<span class="span_1">AÑADIR SEGUIMIENTO</span>
									</button>
									<?php endif; ?>
									
								</div>
									
							</form>
								
						</div>
					</div>
				</div>
				<div>
					<br>
					<form action="../../controllers/controlador_ver_paciente_4.php" method="post">
						<input type="hidden" id="paciente_objeto" name="paciente_objeto" value="<?php $paciente_objeto ?>">
						<input type="hidden" id="nombre_usuario" name="nombre_usuario" value="<?php $nombre_usuario ?>">
						<input type="hidden" id="usuario_objeto" name="usuario_objeto" value="<?php $usuario_objeto ?>">
						<input type="hidden" id="usuario_puesto" name="usuario_puesto" value="<?php $usuario_puesto ?>">
						<input type="hidden" name="fecha_alta" id="fecha_alta" value="<?php echo $fecha_alta; ?>">
						<input type="hidden" name="fecha_baja" id="fecha_baja" value="<?php echo $fecha_baja; ?>">
											
						<?php if ($fecha_baja=="" && $usuario_puesto!="Enfermero"): ?>
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
								<br>
								<button class="button_1" style="font-size: 20px; width: 320px; margin-left: 20px" id="egresa" name="egresa" type="submit">
									<span class="span_1">CONFIRMAR</span>
								</button>
							</div>
						</div>
						<?php elseif($usuario_puesto!="Enfermero"): ?>
						<h2 class="aplicacion-salvavidas-3">¿Ingresa otra vez a terapia intensiva?</h2>
						<div class="row">
							<div class="col-lg-6">
								<div class="col-md-12 form-group">
									<label>Fecha de ingreso:</label>
									<input type="datetime-local" class="form-control dobpicker required" name="fecha_alta_mod" id="fecha_alta_mod" placeholder="MM/DD/YYYY" data-date-end-date="-18y" value="" required>
									<label>Descripción:</label>
									<textarea name="descripcion_alta_mod" id="descripcion_alta_mod" class="form-control required" placeholder="Descripción" value="" required></textarea>
								</div>
							</div>
							<div class="col-lg-6 ps-lg-6">
								<button class="button_1" style="font-size: 20px; width: 380px; margin-left: 20px" id="ingresa" name="ingresa" type="submit">
									<span class="span_1">CONFIRMAR</span>
								</button>
							</div>
						</div>
						<?php endif; ?>
					</form>
				</div>
					<!-- Datos que se pueden modificar -->
					<!-- Domicilios -->
				<br>
				<div class="table-responsive">
					<h2 class="aplicacion-salvavidas-3">Domicilios</h2>
					<table id="datatable9" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
							<?php if (!empty($lista_domicilios)): ?>
							<?php foreach ($lista_domicilios as $domicilio): ?>
								<tr>
									<td><?php echo htmlspecialchars($domicilio['dom_calle']); ?></td>
									<td><?php echo htmlspecialchars($domicilio['dom_numero']); ?></td>
									<td><?php echo htmlspecialchars($domicilio['ciu_nombre']); ?></td>
									<td><?php echo htmlspecialchars($domicilio['pai_nombre']); ?></td>
								</tr>
							<?php endforeach; ?>
							<?php else: ?>
								<tr>
									<td colspan="4">No se encontraron domicilios registrados.</td>
								</tr>
							<?php endif; ?>
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
							<?php if (!empty($lista_contactos)): ?>
							<?php foreach ($lista_contactos as $contacto): ?>
								<tr>
									<td><?php echo htmlspecialchars($contacto['con_tipo']); ?></td>
									<td><?php echo htmlspecialchars($contacto['con_medio']); ?></td>
									<td><?php echo htmlspecialchars($contacto['con_valor_contacto']); ?></td>
								</tr>
							<?php endforeach; ?>
							<?php else: ?>
								<tr>
									<td colspan="3">No se encontraron contactos registrados.</td>
								</tr>
							<?php endif; ?>
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
							<?php if (!empty($lista_tratamientos_actuales)): ?>
								<?php foreach ($lista_tratamientos_actuales as $tratamiento): ?>
									<tr>
										<td><?php echo htmlspecialchars($tratamiento['tratamiento_tipo']); ?></td>
										<td><?php echo htmlspecialchars($tratamiento['tratamiento_nombre']); ?></td>
										<td><?php echo htmlspecialchars($tratamiento['tratamiento_fecha_inicio']); ?></td>
										<td><?php echo htmlspecialchars($tratamiento['tratamiento_descrip']); ?></td>
										<form action="../../controllers/controlador_ver_tratamiento_1.php" method="post">
										<td><button class="button_1" value=<?php echo htmlspecialchars($tratamiento['tra_id_tratamiento']) ?> name="tratamiento_id" type="submit"><span class="span_1">Ver <?php echo htmlspecialchars($tratamiento['cant_medicamento']); ?> medicamento/s</span></button></td>
										</form>
									</tr>
								<?php endforeach; ?>
								<?php else: ?>
									<tr>
										<td colspan="5">No se encontraron tratamientos actuales.</td>
									</tr>
							<?php endif; ?>
						</tbody>
					</table>
				</div>
				<br />
				<!-- Enfermedades actuales -->
				<div class="table-responsive">
					<h2 class="aplicacion-salvavidas-3">Enfermedades actuales</h2>
					<table id="datatable4" class="table table-striped table-bordered" cellspacing="0" width="100%">

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
							<?php if (!empty($lista_enfermedades_actuales)): ?>
							<?php foreach ($lista_enfermedades_actuales as $enfermedad): ?>
								<tr>
									<td><?php echo htmlspecialchars($enfermedad['enfermedad_tipo']); ?></td>
									<td><?php echo htmlspecialchars($enfermedad['enfermedad_nombre']); ?></td>
									<td><?php echo htmlspecialchars($enfermedad['enfermedad_fecha_inicio']); ?></td>
									<td><?php echo htmlspecialchars($enfermedad['enfermedad_descrip']); ?></td>
									<td><?php echo htmlspecialchars($enfermedad['enfermedad_nivel']); ?></td>
									<form action="../../controllers/controlador_ver_enfermedad_1.php" method="post">
									<td><button class="button_1" value=<?php echo htmlspecialchars($enfermedad['enf_id_enfermedad']) ?> name="enfermedad_id" type="submit"><span class="span_1">Ver <?php echo htmlspecialchars($enfermedad['cant_sintoma']); ?> sintoma/s</span></button></td>
									</form>
								</tr>
							<?php endforeach; ?>
							<?php else: ?>
								<tr>
									<td colspan="6">No se encontraron enfermedades actuales.</td>
								</tr>
							<?php endif; ?>
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
								<th>Fecha de inicio</th>
								<th>Fecha de fin</th>
								<th>Resultado</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>Tipo</th>
								<th>Nombre</th>
								<th>Frecuencia</th>
								<th>Fecha de inicio</th>
								<th>Fecha de fin</th>
								<th>Resultado</th>
							</tr>
						</tfoot>
						<tbody>
							<?php if (!empty($lista_antecedentes)): ?>
							<?php foreach ($lista_antecedentes as $antecedente): ?>
								<tr>
									<td><?php echo htmlspecialchars($antecedente['antecedente_tipo']); ?></td>
									<td><?php echo htmlspecialchars($antecedente['antecedente_nombre']); ?></td>
									<td><?php echo htmlspecialchars($antecedente['antecedente_frecuencia']); ?></td>
									<td><?php echo htmlspecialchars($antecedente['fecha_inicio']); ?></td>
									<td><?php echo htmlspecialchars($antecedente['fecha_fin']); ?></td>
									<td><?php echo htmlspecialchars($antecedente['resultado']); ?></td>
								</tr>
							<?php endforeach; ?>
							<?php else: ?>
								<tr>
									<td colspan="6">No se encontraron antecedentes.</td>
								</tr>
							<?php endif; ?>
						</tbody>
					</table>
				</div>
				<br />
				<!-- Seguimientos -->
				<div class="table-responsive">
					<h2 class="aplicacion-salvavidas-3">Seguimientos</h2>
					<table id="datatable7" class="table table-striped table-bordered" cellspacing="0" width="100%">

						<thead>
							<tr>
								<th>DNI Enfermera/o</th>
								<th>Fecha de inicio</th>
								<th>Fecha de fin</th>
								<th>Descripción</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>DNI Enfermera/o</th>
								<th>Fecha de inicio</th>
								<th>Fecha de fin</th>
								<th>Descripción</th>
							</tr>
						</tfoot>
						<tbody>
							<?php if (!empty($lista_seguimientos)): ?>
							<?php foreach ($lista_seguimientos as $seguimiento): ?>
								<tr>
									<td><?php echo htmlspecialchars($seguimiento['enfermero_dni']); ?></td>
									<td><?php echo htmlspecialchars($seguimiento['seg_fecha_inicio']); ?></td>
									<td><?php echo htmlspecialchars($seguimiento['seg_fecha_fin']); ?></td>
									<td><?php echo htmlspecialchars($seguimiento['seg_descripcion']); ?></td>
								</tr>
							<?php endforeach; ?>
							<?php else: ?>
								<tr>
									<td colspan="4">No se encontraron seguimientos.</td>
								</tr>
							<?php endif; ?>
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
							<?php if (!empty($lista_tratamientos_finalizados)): ?>
								<?php foreach ($lista_tratamientos_finalizados as $tratamiento): ?>
									<tr>
										<td><?php echo htmlspecialchars($tratamiento['tratamiento_tipo']); ?></td>
										<td><?php echo htmlspecialchars($tratamiento['tratamiento_nombre']); ?></td>
										<td><?php echo htmlspecialchars($tratamiento['tratamiento_fecha_inicio']); ?></td>
										<td><?php echo htmlspecialchars($tratamiento['tratamiento_descrip']); ?></td>
										<td><?php echo htmlspecialchars($tratamiento['tratamiento_fecha_fin']); ?></td>
										<td><?php echo htmlspecialchars($tratamiento['tratamiento_resultado']); ?></td>
										<form action="../../controllers/controlador_ver_tratamiento_1.php" method="post">
										<td><button class="button_1" value=<?php echo htmlspecialchars($tratamiento['tra_id_tratamiento']) ?> name="tratamiento_id" type="submit"><span class="span_1">Ver <?php echo htmlspecialchars($tratamiento['cant_medicamento']); ?> medicamento/s</span></button></td>
										</form>
									</tr>
								<?php endforeach; ?>
								<?php else: ?>
									<tr>
										<td colspan="7">No se encontraron tratamientos finalizados.</td>
									</tr>
							<?php endif; ?>
						</tbody>
					</table>
				</div>
				<br />
				<!-- Enfermedades finalizadas -->
				<div class="table-responsive">
					<h2 class="aplicacion-salvavidas-3">Enfermedades finalizadas</h2>
					<table id="datatable_ef" name="datatable_ef" class="table table-striped table-bordered" cellspacing="0" width="100%">

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
							<?php if (!empty($lista_enfermedades_finalizadas)): ?>
							<?php foreach ($lista_enfermedades_finalizadas as $enfermedad): ?>
								<tr>
									<td><?php echo htmlspecialchars($enfermedad['enfermedad_tipo']); ?></td>
									<td><?php echo htmlspecialchars($enfermedad['enfermedad_nombre']); ?></td>
									<td><?php echo htmlspecialchars($enfermedad['enfermedad_fecha_inicio']); ?></td>
									<td><?php echo htmlspecialchars($enfermedad['enfermedad_descrip']); ?></td>
									<td><?php echo htmlspecialchars($enfermedad['enfermedad_nivel']); ?></td>
									<td><?php echo htmlspecialchars($enfermedad['enfermedad_fecha_fin']); ?></td>
									<td><?php echo htmlspecialchars($enfermedad['enfermedad_resultado']); ?></td>
									<form action="../../controllers/controlador_ver_enfermedad_1.php" method="post">
									<td><button class="button_1" value=<?php echo htmlspecialchars($enfermedad['enf_id_enfermedad']) ?> name="enfermedad_id" type="submit"><span class="span_1">Ver <?php echo htmlspecialchars($enfermedad['cant_sintoma']); ?> sintoma/s</span></button></td>
									</form>
								</tr>
							<?php endforeach; ?>
							<?php else: ?>
								<tr>
									<td colspan="8">No se encontraron enfermedades finalizadas.</td>
								</tr>
							<?php endif; ?>
						</tbody>
					</table>
				</div>
				<br />

				<br />
				<h1 class="aplicacion-salvavidas-3">Historia Clínica Completa</h1>
				<!-- Fichas médicas -->
				<div class="table-responsive">
					<h2 class="aplicacion-salvavidas-3">Fichas médicas</h2>
					<table id="datatable2" class="table table-striped table-bordered" cellspacing="0" width="100%">

						<thead>
							<tr>
								<th>DNI Médica/o</th>
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
								<th>DNI Médica/o</th>
								<th>Especialidad</th>
								<th>Fecha</th>
								<th>Cant. Tratamientos</th>
								<th>Cant. Enfermedades</th>
								<th>Cant. Antecedentes</th>
								<th>Ver ficha</th>
							</tr>
						</tfoot>
						<tbody>
							<?php if (!empty($lista_fichas_medicas)): ?>
							<?php foreach ($lista_fichas_medicas as $ficha_medica): ?>
								<tr>
									<td><?php echo htmlspecialchars($ficha_medica['per_dni']); ?></td>
									<td><?php echo htmlspecialchars($ficha_medica['medper_especialidad']); ?></td>
									<td><?php echo htmlspecialchars($ficha_medica['fic_fecha_ficha']); ?></td>
									<td><?php echo htmlspecialchars($ficha_medica['cant_tratamientos']); ?></td>
									<td><?php echo htmlspecialchars($ficha_medica['cant_enfermedades']); ?></td>
									<td><?php echo htmlspecialchars($ficha_medica['cant_antecedentes']); ?></td>
									<form action="../../controllers/controlador_ver_ficha_medica_1.php" method="post">
									<td><button class="button_1" value=<?php echo htmlspecialchars($ficha_medica['fic_id_ficha']) ?> name="ficha_id" type="submit"><span class="span_1">Ver ficha</span></button></td>
									</form>
								</tr>
							<?php endforeach; ?>
							<?php else: ?>
								<tr>
									<td colspan="7">No se encontraron fichas médicas.</td>
								</tr>
							<?php endif; ?>
						</tbody>
					</table>
				</div>
				<br>
			</div>
		</section>
		
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
		});
		jQuery(document).ready(function() {
			jQuery('#datatable2').dataTable();
		});
		jQuery(document).ready(function() {
            jQuery('#datatable3').dataTable();
		});
		jQuery(document).ready(function() {
			jQuery('#datatable4').dataTable();
		});
		jQuery(document).ready(function() {
			jQuery('#datatable5').dataTable();
		});
		jQuery(document).ready(function() {
			jQuery('#datatable_ef').dataTable();
			jQuery('#datatable7').dataTable();
			jQuery('#datatable8').dataTable();
			jQuery('#datatable9').dataTable();
		});
	</script>
	<script>
		// Muestra el loader cuando la página empieza a cargarse
		document.addEventListener("DOMContentLoaded", function() {
			document.getElementById("loader_corazon").style.display = "block";
		});
		// Oculta el loader cuando la carga de la página se completa
		window.addEventListener("load", function() {
			document.getElementById("loader_corazon").style.display = "none";
		});
		function exportToExcel() {
			//const wb = XLSX.utils.table_to_book(document.getElementById('content'), { sheet: "SheetJS" });
			//XLSX.writeFile(wb, 'filename.xlsx');

			// Capturar los valores de los campos del paciente
			const dni = document.getElementById('dni').value;
			const nombre = document.getElementById('nombre').value;
			const apellido = document.getElementById('apellido').value;
			const fecha_nacimiento = document.getElementById('fecha_nacimiento').value;
			const estatura = document.getElementById('estatura').value;
			const peso = document.getElementById('peso').value;
			const edad = document.getElementById('edad').value;
			const imc = document.getElementById('imc').value;
			const sexo = document.querySelector('input[name="sexo"]:checked').value;
			const tipo_sangre = document.getElementById('tipo_sangre').value;
			const fecha_alta = document.getElementById('fecha_alta').value;
			const descripcion_alta = document.getElementById('descripcion_alta').value;
			const fecha_baja = document.getElementById('fecha_baja').value;
			const descripcion_baja = document.getElementById('descripcion_baja').value;
			
			// Crear un nombre de archivo basado en el DNI, nombre y apellido del paciente
			const filename = `${dni}_${nombre}_${apellido}.xlsx`;

			// Crear un nuevo libro de Excel
			const wb = XLSX.utils.book_new();

			// Crear una hoja de cálculo y agregar los datos del paciente
			const ws_data = [
				["DNI", "Nombre", "Apellido", "Fecha de nacimiento", "Estatura (m)", "Peso (kg)", "Edad", "IMC", "Sexo", "Tipo de sangre", "Fecha de ingreso", "Descripción de ingreso", "Fecha de egreso", "Descripción de egreso"],
				[dni, nombre, apellido, fecha_nacimiento, estatura, peso, edad, imc, sexo, tipo_sangre, fecha_alta, descripcion_alta, fecha_baja, descripcion_baja]
			];
			const ws = XLSX.utils.aoa_to_sheet(ws_data);

			// Agregar la hoja de cálculo al libro de Excel
			XLSX.utils.book_append_sheet(wb, ws, "Paciente");

			// Agregar cada tabla a una pestaña diferente
			addTableToSheet(wb, 'Domicilios', 'datatable9');
			addTableToSheet(wb, 'Contactos', 'datatable8');
			addTableToSheet(wb, 'Fichas Medicas', 'datatable2');
			addTableToSheet(wb, 'Enfermedades Actuales', 'datatable4');
			addTableToSheet(wb, 'Tratamientos Actuales', 'datatable1');
			addTableToSheet(wb, 'Antecedentes', 'datatable3');
			//addTableToSheet(wb, 'Seguimientos', 'datatable7');
			addTableToSheet(wb, 'Enfermedades Finalizadas', 'datatable_ef');
			addTableToSheet(wb, 'Tratamientos Finalizados', 'datatable5');
			

			// Agregar la tabla al libro de Excel
			//const table = document.getElementById('content');
			//const ws2 = XLSX.utils.table_to_sheet(table);
			//XLSX.utils.book_append_sheet(wb, ws2, "Tabla");

			// Guardar el archivo Excel
			XLSX.writeFile(wb, filename);

		}
		function addTableToSheet(workbook, sheetName, tableId) {
			// Obtener la tabla HTML por su ID
			const table = document.getElementById(tableId);

			// Crear una hoja de cálculo y agregar los datos de la tabla
			const ws_data = XLSX.utils.table_to_sheet(table);

			// Agregar la hoja de cálculo al libro de Excel con el nombre de la pestaña
			XLSX.utils.book_append_sheet(workbook, ws_data, sheetName);
		}
	</script>
</body>
</html>