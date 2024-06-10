<?php
require "../../controllers/controlador_inicio_3.php";
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
	<!-- script de SweetAlert2 -->
    <script src="https://unpkg.com/sweetalert2@9.5.3/dist/sweetalert2.all.min.js"></script>

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
	<title>Salvavidas | Registro Paciente</title>

</head>

<body class="stretched" data-menu-breakpoint="1200" >
	<div id="loader_corazon" class="loader_corazon"></div>
	

	<div class="desktop bg-gradient-to-br from-orange-500 to-orange-700">
		<div id="wrapper" class="bg-gradient-to-br from-orange-500 to-orange-700">
		
			<section id="content" class="bg-gradient-to-br from-orange-300 to-orange-500 rounded-3xl shadow-lg p-8 max-w-6xl w-full mx-auto">
				<h1 class="aplicacion-salvavidas animate-pulse">Registro</h1>
				<div class="content-wrap">
					<div class="container">
						<div class="form-widget">
							<form class="row" action="../../controllers/controlador_registro_1.php" method="post" enctype="multipart/form-data">
								<?php if (isset($_GET['error'])): ?>
									<script>
										document.addEventListener('DOMContentLoaded', function() {
											Swal.fire({
												icon: 'error',
												title: 'Error',
												confirmButtonText: "OK",
												confirmButtonColor: "#D05F1F",
												html: '<div style="text-align: left;"><?php echo $_GET['error']; ?></div>'
											});
										});
									</script>
								<?php endif; ?>
								<?php if (isset($_GET['exito'])): ?>
									<script>
										document.addEventListener('DOMContentLoaded', function() {
											Swal.fire({
												icon: "success",
												title: "¡Paciente registrad@!",
												showConfirmButton: false,
												timer: 1500
											});
										});
									</script>
								<?php endif; ?>
								<input type="hidden" id="nombre_usuario" name="nombre_usuario" value="<?php $nombre_usuario?>">
								<input type="hidden" id="usuario_objeto" name="usuario_objeto" value="<?php $usuario_objeto?>">
								<input type="hidden" id="usuario_puesto" name="usuario_puesto" value="<?php $usuario_puesto?>">
							
								<div class="form-process">
									<div class="css3-spinner">
										<div class="css3-spinner-scaler"></div>
									</div>
								</div>
								<div class="col-md-4 form-group">
									<label>DNI *</label>
									<input type="number" name="dni" id="dni" class="form-control required" value="" placeholder="DNI" required>
								</div>
								<div class="col-md-4 form-group">
									<label>Nombre *</label>
									<input type="text" name="nombre" id="nombre" class="form-control required" value="" placeholder="Nombre" required>
								</div>
								<div class="col-md-4 form-group">
									<label>Apellido *</label>
									<input type="text" name="apellido" id="apellido" class="form-control required" value="" placeholder="Apellido" required>
								</div>
								<div class="col-md-4 form-group">
									<label>Estatura (m) *</label>
									<input type="number" step="0.01" name="estatura" id="estatura" class="form-control required" value="" placeholder="Estatura" required>
								</div>
								<div class="col-md-4 form-group">
									<label>Peso (kg) *</label>
									<input type="number" step="0.01" name="peso" id="peso" class="form-control required" value="" placeholder="Peso" required>
								</div>
								<div class="col-md-4 form-group">
									<label>Fecha de nacimiento *</label>
									<input type="date" class="form-control dobpicker required" name="fecha_nacimiento" id="fecha_nacimiento" value="" placeholder="MM/DD/YYYY" required data-date-end-date="-18y">
								</div>
								<div class="col-md-4 form-group">
									<label>Sexo *</label>
									<div class="btn-group d-flex" data-bs-toggle="buttons">
										<input type="radio" class="btn-check" name="sexo" id="sexo-male" value="hombre" required>
										<label class="btn btn-outline-secondary text-transform-none ls-0" for="sexo-male">Hombre</label>
										<input type="radio" class="btn-check" name="sexo" id="sexo-female" value="mujer" required>
										<label class="btn btn-outline-secondary text-transform-none ls-0" for="sexo-female">Mujer</label>
									</div>
								</div>
								<div class="col-md-4 form-group">
									<label>Tipo de sangre *</label>
									<select class="form-select required" name="tipo_sangre" id="tipo_sangre" required>
										<option value="">-- Selecciona Uno --</option>
										<option value="O+">O+</option>
										<option value="O-">O-</option>
										<option value="A+">A+</option>
										<option value="A-">A-</option>
										<option value="B+">B+</option>
										<option value="B-">B-</option>
										<option value="AB+">AB+</option>
										<option value="AB-">AB-</option>
									</select>
								</div>
								<div class="col-md-4 form-group">
									<label>Fecha de ingreso *</label>
									<input type="datetime-local" class="form-control dobpicker required" name="fecha_alta" id="jobs-application-date-of-birth" value="" placeholder="MM/DD/YYYY" required data-date-end-date="-18y">
								</div>
								<div class="col-md-4 form-group">
									<label>Descripción *</label>
									<textarea name="descripcion" id="descripcion" class="form-control required" value="" placeholder="Descripción" required></textarea>
								</div>
								<div class="col-md-8 form-group" style="margin-top: 30px">
									<button class="button_1" id="registrar_paciente" name="registrar_paciente" type="submit">
										<span class="span_1">REGISTRAR PACIENTE</span>
									</button>
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
	
	<!-- Input para el texto del código QR  <a type="hidden">Generador de Código QR</a>-->
	<input type="hidden" id="text" placeholder="Introduce el texto">

	<!-- Contenedor para el código QR -->
	<div id="qrcode"></div>
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