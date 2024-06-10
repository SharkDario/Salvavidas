<?php
require "../../controllers/controlador_annadir_ficha_medica_1.php";
?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<meta http-equiv="x-ua-compatible" content="IE=edge">
	<meta name="author" content="Miguel Dario Coronel">
	<meta name="description" content="Bootstrap Template by Canvas">
	<script src="https://cdn.tailwindcss.com"></script>
	<link rel="stylesheet" href="../index.css" />

	<!-- Font Imports -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=JetBrains Mono:wght@300;400;500;600;700&display=swap" />

	<!-- Core Style -->
	<link rel="stylesheet" href="style.css?v=1.0">
	<script src="2functions.js"></script>
	<!-- script de SweetAlert2 -->
    <script src="https://unpkg.com/sweetalert2@9.5.3/dist/sweetalert2.all.min.js"></script>

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
	<title>Salvavidas | Registro Ficha Médica</title>
	<style>
        .toggle-button {
            cursor: pointer;
            display: flex;
            align-items: center;
        }
        .toggle-button span {
            margin-left: 10px;
            font-size: 40px;
            transition: transform 0.3s ease;
        }
        .toggle-button .arrow.down {
            transform: rotate(90deg);
        }
    </style>
</head>

<body class="stretched" data-menu-breakpoint="1200" >
	<div id="loader_corazon" class="loader_corazon"></div>
	

	<div class="desktop bg-gradient-to-br from-orange-500 to-orange-700">
		<div id="wrapper" class="bg-gradient-to-br from-orange-500 to-orange-700">
		
			<section id="content" class="bg-gradient-to-br from-orange-300 to-orange-500 rounded-3xl shadow-lg p-8 max-w-7xl w-full mx-auto">
				
				<div class="content-wrap">
					<div class="container">
						<h1 class="aplicacion-salvavidas-2 animate-pulse">Añadir Ficha Médica</h1>
						<div class="form-widget">
							<form name="form-ficha" id="form-ficha" method="post" action="../../controllers/controlador_annadir_ficha_medica_2.php">
								<input type="hidden" id="paciente_objeto" name="paciente_objeto" value="<?php $paciente_objeto ?>">
								<input type="hidden" id="paciente_id" name="paciente_id" value="<?php echo $_GET['id'] ?>">
								<input type="hidden" id="nombre_usuario" name="nombre_usuario" value="<?php $nombre_usuario ?>">
								<input type="hidden" id="usuario_objeto" name="usuario_objeto" value="<?php $usuario_objeto ?>">
								<input type="hidden" id="usuario_puesto" name="usuario_puesto" value="<?php $usuario_puesto ?>">
								<input type="hidden" id="data" name="data">
    
								<?php if (isset($_GET['mensaje'])): $mensaje = htmlspecialchars_decode($_GET['mensaje'], ENT_QUOTES); ?>
								<script>
									document.addEventListener('DOMContentLoaded', function() {
										Swal.fire({
											icon: 'warning',
											title: 'Ficha Médica',
											confirmButtonText: "OK",
											confirmButtonColor: "#D05F1F",
											html: '<?php echo $mensaje; ?>'
										});
									});
								</script>
                				<?php endif; ?>
							
								<div class="row">
									<div class="col-md-1 form-group">
									</div>
									<div class="col-md-4 form-group">
										<label>Fecha de ficha:</label>
										<input type="datetime-local" class="form-control dobpicker required" name="fecha_ficha" id="fecha_ficha" value="" placeholder="MM/DD/YYYY" required data-date-end-date="-18y">
									</div>
									<div class="col-md-6 form-group">
										<button class="button_1" style="font-size: 25px; width: 350px; margin-top: 10px" id="annadir_ficha_medica" name="annadir_ficha_medica" type="submit">
											<span class="span_1">AÑADIR FICHA MÉDICA</span>
										</button>
									</div>
								</div>
								<br>
								<br>
								<!-- ENFERMEDADES -->
								<div class="row bg-gradient-to-br from-orange-500 to-orange-700 rounded-3xl shadow-lg p-8 max-w-6xl w-full mx-auto">
									<div class="toggle-button" onclick="toggleForm('form-container-3')">
										<h2 class="aplicacion-salvavidas-3" style="font-size: 40px">Enfermedades</h2>
										<span class="arrow">►</span>
									</div>
									<div id="form-container-3" class="form-container" style="display: none;">
										<div class="row">
											<?php if (!empty($lista_tipo_enfermedad)): ?>
												<div class="col-md-4 form-group">
													<label>Tipo *</label>
													<select class="form-select tipo-enfermedad" name="tipo_enfermedad" id="tipo_enfermedad">
													<option value="">-- Selecciona Uno --</option>
												<?php foreach ($lista_tipo_enfermedad as $tipo): ?>
														<option value="<?php echo $tipo['tipenf_id_tipo_enfermedad']; ?>">
															<?php echo $tipo['tipenf_nombre']; ?>
														</option>
												<?php endforeach; ?>
													</select>
													</div>
												<div class="col-md-4 form-group">
													<label>Nombre *</label>
													<select class="form-select nombre-enfermedad" name="nombre_enfermedad" id="nombre_enfermedad">
														<option value="">-- Selecciona Uno --</option>
														<!-- Las opciones se generarán dinámicamente con JavaScript -->
													</select>
												</div>
											<?php else: ?>
												<div class="col-md-4 form-group">
													<label>Tipo *</label>
													<select class="form-select" name="tipo_enfermedad" id="tipo_enfermedad">
														<option value="">-- Selecciona Uno --</option>
														<option value="">No existen registros</option>
													</select>
												</div>
												<div class="col-md-4 form-group">
													<label>Nombre *</label>
													<select class="form-select" name="nombre_enfermedad" id="nombre_enfermedad">
														<option value="">-- Selecciona Uno --</option>
														<option value="">No existen registros</option>
													</select>
												</div>
											<?php endif; ?>

									
											<div class="col-md-4 form-group">
												<label>Fecha de inicio *</label>
												<input type="datetime-local" class="form-control dobpicker" name="fecha_inicio_enfermedad" id="fecha_inicio_enfermedad" value="" placeholder="MM/DD/YYYY" data-date-end-date="-18y">
											</div>
										</div>
										<div class="row">
											<div class="col-md-12 form-group">
												<label>Descripción *</label>
												<textarea name="descripcion_enfermedad" id="descripcion_enfermedad" class="form-control" placeholder="Descripción" value="" ></textarea>
											</div>
										</div>
										<div class="row">
											<div class="col-md-4 form-group">
												<label>Nivel de gravedad *</label>
												<textarea name="nivel_enfermedad" id="nivel_enfermedad" class="form-control" placeholder="Nivel de gravedad" value="" 
														  ></textarea>
											</div>
											<div class="col-md-4 form-group">
												<label>Resultado</label>
												<textarea name="resultado_enfermedad" id="resultado_enfermedad" class="form-control" placeholder="Resultado" value=""></textarea>
											</div>
											<div class="col-md-4 form-group">
												<label>Fecha de fin</label>
												<input type="datetime-local" class="form-control dobpicker" name="fecha_fin_enfermedad" id="fecha_fin_enfermedad" value="" placeholder="MM/DD/YYYY" data-date-end-date="-18y">
											</div>
										</div>
										<br>
										<h3 class="aplicacion-salvavidas-3">Síntomas</h3>
										<div class="row">
											<?php if (!empty($lista_sintomas)): ?>
												<div class="col-md-4 form-group">
													<label>Nombre *</label>
													<select class="form-select" name="nombre_sintoma" id="nombre_sintoma">
														<option value="">-- Selecciona Uno --</option>
												<?php foreach ($lista_sintomas as $nombre): ?>
														<option value="<?php echo $nombre['sin_id_sintoma']; ?>">
															<?php echo $nombre['sin_nombre']; ?>
														</option>
												<?php endforeach; ?>
													</select>
													</div>
											<?php else: ?>
												<div class="col-md-4 form-group">
													<label>Nombre *</label>
													<select class="form-select" name="nombre_sintoma" id="nombre_sintoma">
														<option value="">-- Selecciona Uno --</option>
														<option value="">No existen registros</option>
													</select>
												</div>
											<?php endif; ?>
											

											<div class="col-md-4 form-group">
												<label>Fecha de inicio *</label>
												<input type="datetime-local" class="form-control dobpicker" name="fecha_inicio_sintoma" id="fecha_inicio_sintoma" value="" placeholder="MM/DD/YYYY" data-date-end-date="-18y">
											</div>

											<div class="col-md-4 form-group">
												<label>Frecuencia *</label>
												<input type="text" name="frecuencia_sintoma" id="frecuencia_sintoma" class="form-control" value="" placeholder="Frecuencia">
											</div>
										</div>
										<div class="row">
											<div class="col-md-4 form-group">
												<br>
												<button class="button_1" style="font-size: 15px; width: 200px; margin-top: 20px; margin-left: 20px; background-color: #FFC288" id="annadir_sintoma" name="annadir_sintoma" type="button">
													<span class="span_1">AÑADIR SÍNTOMA</span>
												</button>
											</div>

											<div class="col-md-8 form-group">
												<label>Síntomas añadidos *</label>
												<textarea name="sintomas_annadidos" id="sintomas_annadidos" class="form-control" value="" readonly></textarea>
											</div>
										</div>
										<div class="row">
											<div class="col-md-4 form-group">
												<br>
												<button class="button_1" style="font-size: 20px; width: 300px; margin-top: 15px; background-color: #FFC288" id="annadir_enfermedad" name="annadir_enfermedad" type="button">
													<span class="span_1">AÑADIR ENFERMEDAD</span>
												</button>
											</div>

											<div class="col-md-8 form-group">
												<label>Enfermedades añadidas *</label>
												<textarea name="enfermedades_annadidas" id="enfermedades_annadidas" class="form-control" value="" readonly></textarea>
											</div>
										</div>
									</div>
								</div>
								<br>
								<br>
								<br>
								<br>
								<!-- TRATAMIENTOS -->
								<div class="row bg-gradient-to-br from-orange-500 to-orange-700 rounded-3xl shadow-lg p-8 max-w-6xl w-full mx-auto">
									<div class="toggle-button" onclick="toggleForm('form-container-2')">
										<h2 class="aplicacion-salvavidas-3" style="font-size: 40px">Tratamientos</h2>
										<span class="arrow">►</span>
									</div>
									<div id="form-container-2" class="form-container" style="display: none;">
										<div class="row">
											<?php if (!empty($lista_tipo_tratamiento)): ?>
												<div class="col-md-4 form-group">
													<label>Tipo *</label>
													<select class="form-select tipo-tratamiento" name="tipo_tratamiento" id="tipo_tratamiento">
													<option value="">-- Selecciona Uno --</option>
												<?php foreach ($lista_tipo_tratamiento as $tipo): ?>
														<option value="<?php echo $tipo['tiptra_id_tipo_tratamiento']; ?>">
															<?php echo $tipo['tiptra_nombre']; ?>
														</option>
												<?php endforeach; ?>
													</select>
													</div>
												<div class="col-md-4 form-group">
													<label>Nombre *</label>
													<select class="form-select nombre-tratamiento" name="nombre_tratamiento" id="nombre_tratamiento">
														<option value="">-- Selecciona Uno --</option>
														<!-- Las opciones se generarán dinámicamente con JavaScript -->
													</select>
												</div>
											<?php else: ?>
												<div class="col-md-4 form-group">
													<label>Tipo *</label>
													<select class="form-select" name="tipo_tratamiento" id="tipo_tratamiento">
														<option value="">-- Selecciona Uno --</option>
														<option value="">No existen registros</option>
													</select>
												</div>
												<div class="col-md-4 form-group">
													<label>Nombre *</label>
													<select class="form-select" name="nombre_tratamiento" id="nombre_tratamiento">
														<option value="">-- Selecciona Uno --</option>
														<option value="">No existen registros</option>
													</select>
												</div>
											<?php endif; ?>

									
											<div class="col-md-4 form-group">
												<label>Fecha de inicio *</label>
												<input type="datetime-local" class="form-control dobpicker" name="fecha_inicio_tratamiento" id="fecha_inicio_tratamiento" value="" placeholder="MM/DD/YYYY" data-date-end-date="-18y">
											</div>
										</div>
										<div class="row">
											<div class="col-md-12 form-group">
												<label>Descripción *</label>
												<textarea name="descripcion_tratamiento" id="descripcion_tratamiento" class="form-control" placeholder="Descripción" value=""></textarea>
											</div>
										</div>
										<div class="row">
											<div class="col-md-8 form-group">
												<label>Resultado</label>
												<textarea name="resultado_tratamiento" id="resultado_tratamiento" class="form-control" placeholder="Resultado" value=""></textarea>
											</div>
											<div class="col-md-4 form-group">
												<label>Fecha de fin</label>
												<input type="datetime-local" class="form-control dobpicker" name="fecha_fin_tratamiento" id="fecha_fin_tratamiento" value="" placeholder="MM/DD/YYYY" data-date-end-date="-18y">
											</div>
										</div>
										<br>
										<h3 class="aplicacion-salvavidas-3">Medicamentos</h3>
										<div class="row">

											<?php if (!empty($lista_medicamentos_genericos)): ?>
												<div class="col-md-4 form-group">
													<label>Nombre *</label>
													<select class="form-select" name="nombre_medicamento" id="nombre_medicamento">
														<option value="">-- Selecciona Uno --</option>
												<?php foreach ($lista_medicamentos_genericos as $nombre): ?>
														<option value="<?php echo $nombre['medgen_id_medicamento']; ?>">
															<?php echo $nombre['medgen_nombre']; ?>
														</option>
												<?php endforeach; ?>
													</select>
													</div>
											<?php else: ?>
												<div class="col-md-4 form-group">
													<label>Nombre *</label>
													<select class="form-select" name="nombre_medicamento" id="nombre_medicamento">
														<option value="">-- Selecciona Uno --</option>
														<option value="">No existen registros</option>
													</select>
												</div>
											<?php endif; ?>

											<div class="col-md-4 form-group">
												<label>Frecuencia *</label>
												<input type="text" name="frecuencia_medicamento" id="frecuencia_medicamento" class="form-control" value="" placeholder="Frecuencia">
											</div>

											<div class="col-md-4 form-group">
												<label>Dosis (mg) *</label>
												<input type="number" step="0.01" name="dosis" id="dosis" class="form-control" value="" placeholder="Dosis">
											</div>
										</div>
										<div class="row">
											<div class="col-md-4 form-group">
												<label>Indicación *</label>
												<input type="text" name="indicacion_medicamento" id="indicacion_medicamento" class="form-control " value="" placeholder="Indicación">
											</div>

											<div class="col-md-4 form-group">
												<label>Vía transmisión *</label>
												<input type="text" name="via_medicamento" id="via_medicamento" class="form-control" value="" placeholder="Vía transmisión">
											</div>

											<div class="col-md-4 form-group">
												<label>Marca *</label>
												<input type="text" name="marca_medicamento" id="marca_medicamento" class="form-control" value="" placeholder="Marca">
											</div>
										</div>
										<div class="row">
											<div class="col-md-4 form-group">
												<br>
												<button class="button_1" style="font-size: 15px; width: 207px; margin-top: 20px; margin-left: 20px; background-color: #FFC288" id="annadir_medicamento" name="annadir_medicamento" type="button">
													<span class="span_1">AÑADIR MEDICAMENTO</span>
												</button>
											</div>

											<div class="col-md-8 form-group">
												<label>Medicamentos añadidos *</label>
												<textarea name="medicamentos_annadidos" id="medicamentos_annadidos" class="form-control" value="" readonly></textarea>
											</div>
										</div>
										<div class="row">
											<div class="col-md-4 form-group">
												<br>
												<button class="button_1" style="font-size: 20px; width: 300px; margin-top: 15px; background-color: #FFC288" id="annadir_tratamiento" name="annadir_tratamiento" type="button">
													<span class="span_1">AÑADIR TRATAMIENTO</span>
												</button>
											</div>

											<div class="col-md-8 form-group">
												<label>Tratamientos añadidos *</label>
												<textarea name="tratamientos_annadidos" id="tratamientos_annadidos" class="form-control" value="" readonly></textarea>
											</div>
										</div>
									</div>
								</div>
								<br>
								<br>
								<br>
								<br>
								<!-- ANTECEDENTES familiares y habitos -->
								<div class="row bg-gradient-to-br from-orange-500 to-orange-700 rounded-3xl shadow-lg p-8 max-w-6xl w-full mx-auto">
									<div class="toggle-button" onclick="toggleForm('form-container-1')">
										<h2 class="aplicacion-salvavidas-3" style="font-size: 40px; width: 900px">Antecedentes (familiar y hábito)</h2>
										<span class="arrow">►</span>
									</div>
									<div id="form-container-1" class="form-container" style="display: none;">
										<div class="row">
											<div class="col-md-4 form-group">
												<label>Tipo *</label>
												<select class="form-select tipo-antecedente" name="tipo_antecedente" id="tipo_antecedente">
												<option value="">-- Selecciona Uno --</option>
													<option value="familiar">Familiar</option>
													<option value="habito">Hábito</option>
												</select>
											</div>
											<?php if (!empty($lista_antecedentes_genericos)): ?>
												<div class="col-md-4 form-group">
													<label>Nombre *</label>
													<select class="form-select nombre-antecedente" name="nombre_antecedente" id="nombre_antecedente">
														<option value="">-- Selecciona Uno --</option>
														<!-- Las opciones se generarán dinámicamente con JavaScript -->
													</select>
												</div>
											<?php else: ?>
												<div class="col-md-4 form-group">
													<label>Nombre *</label>
													<select class="form-select" name="nombre_antecedente" id="nombre_antecedente">
														<option value="">-- Selecciona Uno --</option>
														<option value="">No existen registros</option>
													</select>
												</div>
											<?php endif; ?>
									
											<div class="col-md-4 form-group">
												<label>Fecha de inicio *</label>
												<input type="datetime-local" class="form-control dobpicker" name="fecha_inicio_antecedente" id="fecha_inicio_antecedente" value="" placeholder="MM/DD/YYYY" data-date-end-date="-18y">
											</div>
										</div>
										<div class="row">
											<div class="col-md-4 form-group">
												<label>Frecuencia</label>
												<input type="number" name="frecuencia_antecedente" id="frecuencia_antecedente" class="form-control" value="" placeholder="Frecuencia x Semana">
											</div>
											<div class="col-md-4 form-group">
												<label>Resultado</label>
												<textarea name="resultado_antecedente" id="resultado_antecedente" class="form-control" placeholder="Resultado" value=""></textarea>
											</div>
											<div class="col-md-4 form-group">
												<label>Fecha de fin</label>
												<input type="datetime-local" class="form-control dobpicker" name="fecha_fin_antecedente" id="fecha_fin_antecedente" value="" placeholder="MM/DD/YYYY" data-date-end-date="-18y">
											</div>
										</div>
										<br>
										<div class="row">
											<div class="col-md-4 form-group">
												<br>
												<button class="button_1" style="font-size: 20px; width: 300px; margin-top: 15px; background-color: #FFC288" id="annadir_antecedente" name="annadir_antecedente" type="button">
													<span class="span_1">AÑADIR ANTECEDENTE</span>
												</button>
											</div>

											<div class="col-md-8 form-group">
												<label>Antecedentes añadidos *</label>
												<textarea name="antecedentes_annadidos" id="antecedentes_annadidos" class="form-control" value="" readonly></textarea>
											</div>
										</div>
									</div>
								</div>
								

							</form>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>

	<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="uil uil-angle-up"></div>

	<!-- JavaScripts
	============================================= -->
	<script src="js/jquery.js"></script>
	<script src="js/functions.js"></script>
	
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	
	<script>
		function toggleForm(containerId) {
			const formContainer = document.getElementById(containerId);
			const arrow = formContainer.previousElementSibling.querySelector('.arrow');
			if (formContainer.style.display === 'none' || formContainer.style.display === '') {
				formContainer.style.display = 'block';
				arrow.classList.add('down');
			} else {
				formContainer.style.display = 'none';
				arrow.classList.remove('down');
			}
		}
	</script>
	<script>
		// Select en Enfermedad
		// Obtener referencia al primer select
		var tipoSelect = document.getElementById('tipo_enfermedad');
		// Obtener referencia al segundo select
		var nombreSelect = document.getElementById('nombre_enfermedad');

		// Manejar el evento de cambio en el primer select
		tipoSelect.addEventListener('change', function() {
			// Limpiar las opciones del segundo select
			nombreSelect.innerHTML = '<option value="">-- Selecciona Uno --</option>';
        
			// Obtener el valor seleccionado en el primer select
			var tipoSeleccionado = tipoSelect.value;
        
			// Iterar sobre la lista de enfermedades genéricas
			<?php foreach ($lista_enfermedades_genericas as $enfermedad): ?>
				// Verificar si la enfermedad coincide con el tipo seleccionado
				if ('<?php echo $enfermedad["tipenf_id_tipo_enfermedad"]; ?>' === tipoSeleccionado) {
					// Crear una nueva opción para el segundo select
					var nuevaOpcion = document.createElement('option');
					nuevaOpcion.value = '<?php echo $enfermedad["enfgen_id_enfermedad"]; ?>';
					nuevaOpcion.textContent = '<?php echo $enfermedad["enfgen_nombre"]; ?>';
					// Agregar la nueva opción al segundo select
					nombreSelect.appendChild(nuevaOpcion);
				}
			<?php endforeach; ?>
		});
	</script>
	<script>
		// Select en Tratamiento
		// Obtener referencia al primer select
		var tipo_select_tra = document.getElementById('tipo_tratamiento');
		// Obtener referencia al segundo select
		var nombre_select_tra = document.getElementById('nombre_tratamiento');

		// Manejar el evento de cambio en el primer select
		tipo_select_tra.addEventListener('change', function() {
			// Limpiar las opciones del segundo select
			nombre_select_tra.innerHTML = '<option value="">-- Selecciona Uno --</option>';
        
			// Obtener el valor seleccionado en el primer select
			var tipo_seleccionado = tipo_select_tra.value;
        
			// Iterar sobre la lista de tratamientos genéricos
			<?php foreach ($lista_tratamientos_genericos as $tratamiento): ?>
				// Verificar si la tratamiento coincide con el tipo seleccionado
				if ('<?php echo $tratamiento["tiptra_id_tipo_tratamiento"]; ?>' === tipo_seleccionado) {
					// Crear una nueva opción para el segundo select
					var nueva_opcion = document.createElement('option');
					nueva_opcion.value = '<?php echo $tratamiento["tragen_id_tratamiento"]; ?>';
					nueva_opcion.textContent = '<?php echo $tratamiento["tragen_nombre"]; ?>';
					// Agregar la nueva opción al segundo select
					nombre_select_tra.appendChild(nueva_opcion);
				}
			<?php endforeach; ?>
		});
	</script>
	<script>
		// Select en Antecedente
		// Obtener referencia al primer select
		var tipo_select_ant = document.getElementById('tipo_antecedente');
		// Obtener referencia al segundo select
		var nombre_select_ant = document.getElementById('nombre_antecedente');

		// Manejar el evento de cambio en el primer select
		tipo_select_ant.addEventListener('change', function() {
			// Limpiar las opciones del segundo select
			nombre_select_ant.innerHTML = '<option value="">-- Selecciona Uno --</option>';
        
			// Obtener el valor seleccionado en el primer select
			var tipo_seleccionado_ant = tipo_select_ant.value;
        
			// Iterar sobre la lista de antecedentes genéricos
			<?php foreach ($lista_antecedentes_genericos as $antecedente): ?>
				// Verificar si la antecedente coincide con el tipo seleccionado
				if ('<?php echo $antecedente["antgen_tipo"]; ?>' === tipo_seleccionado_ant) {
					// Crear una nueva opción para el segundo select
					var nueva_opcion_ant = document.createElement('option');
					nueva_opcion_ant.value = '<?php echo $antecedente["antgen_id_antecedente"]; ?>';
					nueva_opcion_ant.textContent = '<?php echo $antecedente["antgen_nombre"]; ?>';
					// Agregar la nueva opción al segundo select
					nombre_select_ant.appendChild(nueva_opcion_ant);
				}
			<?php endforeach; ?>
		});
	</script>
	
	<script>
		// Estructuras de datos para almacenar las relaciones
		let enfermedadesList = [];
		let tratamientosList = [];
		let medicamentosList = [];
		let sintomasList = [];
		let antecedentesList = [];

		document.getElementById('annadir_antecedente').addEventListener('click', function() {
			// Obtener valores del formulario
			const tipo = document.getElementById('tipo_antecedente').value;
			const nombreElement = document.getElementById('nombre_antecedente');

			const nombre = nombreElement.value;
			const nombreTexto = nombreElement.options[nombreElement.selectedIndex].text;

			const fechaInicio = document.getElementById('fecha_inicio_antecedente').value;
			const frecuencia = document.getElementById('frecuencia_antecedente').value;
			const resultado = document.getElementById('resultado_antecedente').value;
			const fechaFin = document.getElementById('fecha_fin_antecedente').value;

			// Verificar que los campos obligatorios no estén vacíos
			if (!tipo || !nombre || !fechaInicio) {
				Swal.fire({
					icon: 'error',
					title: 'Error',
					text: 'Por favor, complete todos los campos obligatorios de antecedente (*)'
				});
				return;
			}

			if (fechaFin && fechaInicio > fechaFin) {
				Swal.fire({
					icon: 'error',
					title: 'Error',
					text: 'La fecha de inicio del antecedente debe ser anterior a la fecha de fin del mismo'
				});
				return;
			}

			// Crear objeto antecedente
			const antecedente = {
				tipo: tipo,
				nombre: nombre,
				nombreTexto: nombreTexto,
				fechaInicio: fechaInicio,
				frecuencia: frecuencia,
				resultado: resultado,
				fechaFin: fechaFin
			};

			// Añadir a la lista de antecedentes
			antecedentesList.push(antecedente);

			// Actualizar el textarea de manera más legible
			const textarea = document.getElementById('antecedentes_annadidos');
			textarea.value = antecedentesList.map(ant => {
				return `Tipo: ${ant.tipo}\nNombre: ${ant.nombreTexto}\nFecha de Inicio: ${ant.fechaInicio}\nFrecuencia: ${ant.frecuencia}\nResultado: ${ant.resultado}\nFecha de Fin: ${ant.fechaFin}\n\n`;
			}).join('');

			// Limpiar el formulario
			document.getElementById('tipo_antecedente').value = '';
			document.getElementById('nombre_antecedente').value = '';
			document.getElementById('fecha_inicio_antecedente').value = '';
			document.getElementById('frecuencia_antecedente').value = '';
			document.getElementById('resultado_antecedente').value = '';
			document.getElementById('fecha_fin_antecedente').value = '';
		});

		// Función para agregar síntomas a enfermedades
		document.getElementById('annadir_sintoma').addEventListener('click', function () {
			const nombreElement = document.getElementById('nombre_sintoma');
			const nombreSintoma = nombreElement.value;
			const nombreSintomaTexto = nombreElement.options[nombreElement.selectedIndex].text;
			const fechaInicioSintoma = document.getElementById('fecha_inicio_sintoma').value;
			const frecuenciaSintoma = document.getElementById('frecuencia_sintoma').value;

			// Validar si los campos requeridos están llenos
			if (!nombreSintoma || !fechaInicioSintoma) {
				Swal.fire({
					icon: 'error',
					title: 'Error',
					text: 'Por favor, complete todos los campos obligatorios del síntoma (*)'
				});
				return;
			}

			// Crear objeto síntoma
			const sintoma = {
				nombre: nombreSintoma,
				nombreTexto: nombreSintomaTexto,
				fechaInicio: fechaInicioSintoma,
				frecuencia: frecuenciaSintoma
			};

			// Agregar síntoma a la lista de síntomas asociados a la enfermedad
			sintomasList.push(sintoma);

			// Actualizar el textarea
			//document.getElementById('sintomas_annadidos').value = JSON.stringify(sintoma, null, 2);
			const textarea = document.getElementById('sintomas_annadidos');
			textarea.value = sintomasList.map(tra => {
							return `Nombre: ${tra.nombreTexto}\nFecha de Inicio: ${tra.fechaInicio}\nFrecuencia: ${tra.frecuencia}\n\n`;
			}).join('');
			// Limpiar el formulario
			document.getElementById('nombre_sintoma').value = '';
			document.getElementById('fecha_inicio_sintoma').value = '';
			document.getElementById('frecuencia_sintoma').value = '';
		});

		// Función para agregar enfermedades
		document.getElementById('annadir_enfermedad').addEventListener('click', function () {
			// Obtener los valores del formulario de enfermedades
			const tipoElement = document.getElementById('tipo_enfermedad');
			const tipoEnfermedad = tipoElement.value;
			const tipoEnfermedadTexto = tipoElement.options[tipoElement.selectedIndex].text;
			const nombreElement = document.getElementById('nombre_enfermedad');
			const nombreEnfermedad = nombreElement.value;
			const nombreEnfermedadTexto = nombreElement.options[nombreElement.selectedIndex].text;
			const fechaInicioEnfermedad = document.getElementById('fecha_inicio_enfermedad').value;
			const descripcionEnfermedad = document.getElementById('descripcion_enfermedad').value;
			const nivelEnfermedad = document.getElementById('nivel_enfermedad').value;
			const resultado = document.getElementById('resultado_enfermedad').value;
			const fechaFin = document.getElementById('fecha_fin_enfermedad').value;

			// Validar si los campos requeridos están llenos
			if (!tipoEnfermedad || !nombreEnfermedad || !fechaInicioEnfermedad || !descripcionEnfermedad) {
				Swal.fire({
					icon: 'error',
					title: 'Error',
					text: 'Por favor, complete todos los campos obligatorios de la enfermedad (*).'
				});
				return;
			}

			// Crear objeto enfermedad
			const enfermedad = {
				tipo: tipoEnfermedad,
				tipoTexto: tipoEnfermedadTexto,
				nombre: nombreEnfermedad,
				nombreTexto: nombreEnfermedadTexto,
				fechaInicio: fechaInicioEnfermedad,
				descripcion: descripcionEnfermedad,
				nivel: nivelEnfermedad,
				resultado: resultado,
				fechaFin: fechaFin,
				sintomas: sintomasList
			};
			// Se vacia la lista de sintomas
			sintomasList = [];
			// Obtener el textarea
			const textarea_sin = document.getElementById('sintomas_annadidos');
			// Vaciar el contenido del textarea
			textarea_sin.value = '';
			// Agregar enfermedad a la lista de enfermedades
			enfermedadesList.push(enfermedad);

			// Actualizar el textarea
			//document.getElementById('enfermedades_annadidas').value = JSON.stringify(enfermedadesList, null, 2);
			const textarea = document.getElementById('enfermedades_annadidas');
			textarea.value = enfermedadesList.map(tra => {
							return `Tipo: ${tra.tipoTexto}\nNombre: ${tra.nombreTexto}\nFecha de Inicio: ${tra.fechaInicio}\nDescripción: ${tra.descripcion}\nNivel: ${tra.nivel}\nResultado: ${tra.resultado}\nFecha de Fin: ${tra.fechaFin}\nSintomas: ${tra.sintomas}\n\n`;
			}).join('');
			// Limpiar el formulario
			document.getElementById('tipo_enfermedad').value = '';
			document.getElementById('nombre_enfermedad').value = '';
			document.getElementById('fecha_inicio_enfermedad').value = '';
			document.getElementById('descripcion_enfermedad').value = '';
			document.getElementById('resultado_enfermedad').value = '';
			document.getElementById('nivel_enfermedad').value = '';
			document.getElementById('fecha_fin_enfermedad').value = '';
		});

		// Función para agregar medicamentos a tratamientos
		document.getElementById('annadir_medicamento').addEventListener('click', function () {
			const nombreElement = document.getElementById('nombre_medicamento');
			const nombreMedicamento = nombreElement.value;
			const nombreTexto = nombreElement.options[nombreElement.selectedIndex].text;
			const frecuenciaMedicamento = document.getElementById('frecuencia_medicamento').value;
			const dosisMedicamento = document.getElementById('dosis').value;
			const indicacionMedicamento = document.getElementById('indicacion_medicamento').value;
			const viaMedicamento = document.getElementById('via_medicamento').value;
			const marcaMedicamento = document.getElementById('marca_medicamento').value;

			// Validar si los campos requeridos están llenos
			if (!nombreMedicamento || !frecuenciaMedicamento || !dosisMedicamento || !indicacionMedicamento || !viaMedicamento || !marcaMedicamento) {
				Swal.fire({
					icon: 'error',
					title: 'Error',
					text: 'Por favor, complete todos los campos obligatorios del medicamento (*)'
				});
				return;
			}

			// Crear objeto medicamento
			const medicamento = {
				nombre: nombreMedicamento,
				nombreTexto: nombreTexto,
				frecuencia: frecuenciaMedicamento,
				dosis: dosisMedicamento,
				indicacion: indicacionMedicamento,
				via: viaMedicamento,
				marca: marcaMedicamento
			};

			// Agregar medicamento a la lista de medicamentos
			medicamentosList.push(medicamento);

			// Actualizar el textarea
			//document.getElementById('medicamentos_annadidos').value = JSON.stringify(medicamentosList, null, 2);
			const textarea = document.getElementById('medicamentos_annadidos');
			textarea.value = medicamentosList.map(tra => {
							return `Nombre: ${tra.nombreTexto}\nFrecuencia: ${tra.frecuencia}\nDosis: ${tra.dosis}\nIndicación: ${tra.indicacion}\nVía: ${tra.via}\nMarca: ${tra.marca}\n\n`;
			}).join('');
			// Limpiar el formulario
			document.getElementById('nombre_medicamento').value = '';
			document.getElementById('frecuencia_medicamento').value = '';
			document.getElementById('dosis').value = '';
			document.getElementById('indicacion_medicamento').value = '';
			document.getElementById('via_medicamento').value = '';
			document.getElementById('marca_medicamento').value = '';
		});

		// Función para agregar tratamientos
		document.getElementById('annadir_tratamiento').addEventListener('click', function () {
			// Obtener los valores del formulario de tratamientos
			const tipoElement = document.getElementById('tipo_tratamiento');
			const tipoTratamiento = tipoElement.value;
			const tipoTratamientoTexto = tipoElement.options[tipoElement.selectedIndex].text;
			const nombreElement = document.getElementById('nombre_tratamiento');
			const nombreTratamiento = nombreElement.value;
			const nombreTratamientoTexto = nombreElement.options[nombreElement.selectedIndex].text;
			const fechaInicioTratamiento = document.getElementById('fecha_inicio_tratamiento').value;
			const descripcionTratamiento = document.getElementById('descripcion_tratamiento').value;
			const resultadoTratamiento = document.getElementById('resultado_tratamiento').value;
			const fechaFinTratamiento = document.getElementById('fecha_fin_tratamiento').value;

			// Validar si los campos requeridos están llenos
			if (!tipoTratamiento || !nombreTratamiento || !fechaInicioTratamiento || !descripcionTratamiento) {
				Swal.fire({
					icon: 'error',
					title: 'Error',
					text: 'Por favor, complete todos los campos obligatorios del tratamiento (*)'
				});
				return;
			}

			// Crear objeto tratamiento
			const tratamiento = {
				tipo: tipoTratamiento,
				tipoTexto: tipoTratamientoTexto,
				nombre: nombreTratamiento,
				nombreTexto: nombreTratamientoTexto,
				fechaInicio: fechaInicioTratamiento,
				descripcion: descripcionTratamiento,
				resultado: resultadoTratamiento,
				fechaFin: fechaFinTratamiento,
				medicamentos: medicamentosList // Array para almacenar los medicamentos asociados
			};
			// Se vacia la lista de medicamentos
			medicamentosList = [];
			// Obtener el textarea
			const textarea_med = document.getElementById('medicamentos_annadidos');
			// Vaciar el contenido del textarea
			textarea_med.value = '';
			// Agregar tratamiento a la lista de tratamientos
			tratamientosList.push(tratamiento);

			// Actualizar el textarea
			//document.getElementById('tratamientos_annadidos').value = JSON.stringify(tratamientosList, null, 2);
			const textarea = document.getElementById('tratamientos_annadidos');
			textarea.value = tratamientosList.map(tra => {
							return `Tipo: ${tra.tipoTexto}\nNombre: ${tra.nombreTexto}\nFecha de Inicio: ${tra.fechaInicio}\nDescripción: ${tra.descripcion}\nResultado: ${tra.resultado}\nFecha de Fin: ${tra.fechaFin}\nMedicamentos: ${tra.medicamentos}\n\n`;
			}).join('');
			// Limpiar el formulario
			document.getElementById('tipo_tratamiento').value = '';
			document.getElementById('nombre_tratamiento').value = '';
			document.getElementById('fecha_inicio_tratamiento').value = '';
			document.getElementById('descripcion_tratamiento').value = '';
			document.getElementById('resultado_tratamiento').value = '';
			document.getElementById('fecha_fin_tratamiento').value = '';
		});

		// Envía la lista de antecedentes, enfermedades y tratamientos al servidor cuando se envíe el formulario
		/*document.querySelector('nopi').addEventListener('submit', function(event) {
			event.preventDefault(); // Evitar el envío por defecto

			const data = {
				antecedentesList: antecedentesList,
				enfermedadesList: enfermedadesList,
				tratamientosList: tratamientosList
			};

			console.log('Datos a enviar:', data);

			fetch(this.action, {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json'
				},
				body: JSON.stringify(data)
			}).then(response => {
				console.log(response);
				return response.json();
			})
			.then(data => {
				// Manejar la respuesta del servidor
				console.log('Respuesta del servidor:', data);
			})
			.catch(error => {
				console.error('Error:', error);
			});
		});*/
		document.getElementById('form-ficha').addEventListener('submit', function(event) {
			// Serializar las listas en un objeto
			const data = {
				enfermedades: enfermedadesList,
				tratamientos: tratamientosList,
				antecedentes: antecedentesList
			};

			// Convertir el objeto a JSON
			const jsonData = JSON.stringify(data);

			// Asignar el JSON al campo oculto
			document.getElementById('data').value = jsonData;

			// Opcional: Imprimir los datos en consola para verificar
			console.log(jsonData);
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
		
	</script>
</body>
</html>