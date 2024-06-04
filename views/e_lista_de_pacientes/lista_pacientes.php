<?php
require "../../controllers/controlador_lista_pacientes_1.php";
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
	<title>Salvavidas | Lista Pacientes</title>
	<style>
		.button_1 {
            background: #ff6a00;
            border: solid;
            padding: 5px 5px 5px 5px;
            display: inline-block;
            font-size: 15px;
            font-weight: 200;
            width: 150px;
			height: 40px;
            text-transform: uppercase;
            cursor: pointer;
            transform: skew(-21deg);
        }
	</style>
</head>

<body class="stretched" data-menu-breakpoint="1200" >

	<div id="wrapper" class="bg-gradient-to-br from-orange-500 to-orange-700">
		<!-- Content================================ -->
		<section id="content" class="bg-gradient-to-br from-orange-300 to-orange-500 rounded-3xl shadow-lg p-8 max-w-9xl w-full mx-auto">
			<h1 class="aplicacion-salvavidas animate-pulse">Lista de Pacientes</h1>	
			<div class="content-wrap">
				<div class="container">
					
					<!-- Tabla responsiva -->
					<div class="table-responsive">
						<table id="datatable1" class="table table-striped table-bordered" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Fecha de Ingreso (Últ)</th>
									<th>DNI</th>
									<th>Nombre</th>
									<th>Apellido</th>
									<th>Sexo</th>
									<th>Fecha de Nacimiento</th>
									<th>Tipo de sangre</th>
									<th>Estatura</th>
									<th>Peso</th>
									<th>QR</th>
									<th>Ver Paciente</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>Fecha de Ingreso (Últ)</th>
									<th>DNI</th>
									<th>Nombre</th>
									<th>Apellido</th>
									<th>Sexo</th>
									<th>Fecha de Nacimiento</th>
									<th>Tipo de sangre</th>
									<th>Estatura</th>
									<th>Peso</th>
									<th>QR</th>
									<th>Ver Paciente</th>
								</tr>
							</tfoot>
							<tbody>
								
								<?php if (!empty($lista_pacientes)): ?>
									<?php foreach ($lista_pacientes as $paciente): ?>
										<tr>
											<td><?php echo htmlspecialchars($paciente['última_fecha_ingreso']); ?></td>
											<td><?php echo htmlspecialchars($paciente['per_dni']); ?></td>
											<td><?php echo htmlspecialchars($paciente['per_nombre']); ?></td>
											<td><?php echo htmlspecialchars($paciente['per_apellido']); ?></td>
											<td><?php echo htmlspecialchars($paciente['per_sexo']); ?></td>
											<td><?php echo htmlspecialchars($paciente['per_fecha_nacimiento']); ?></td>
											<td><?php echo htmlspecialchars($paciente['per_tipo_sangre']); ?></td>
											<td><?php echo htmlspecialchars($paciente['pac_estatura']); ?></td>
											<td><?php echo htmlspecialchars($paciente['pac_peso']); ?></td>
											<?php
											// Extraer contenido del BLOB
											$blob = file_get_contents($paciente['pac_qr']);
											$base64 = base64_encode($blob);
											?>
											<td><img src="data:image/svg+xml;base64,<?php echo $base64; ?>" width="50" height="50" viewBox="0 0 100 75"></td>
											<form action="../../controllers/controlador_ver_paciente_1.php" method="post">
											<td><button class="button_1" value=<?php echo htmlspecialchars($paciente['pac_id_paciente'])?> name="paciente_id" type="submit"><span class="span_1">Ver paciente</span></button></td>
											</form>
										</tr>
									<?php endforeach; ?>
									<?php else: ?>
										<tr>
											<td colspan="11">No se encontraron pacientes activos.</td>
										</tr>
								<?php endif; ?>
								
							</tbody>
						</table>
					</div>
					<br />
					
					
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
		});
	</script>

</body>
</html>