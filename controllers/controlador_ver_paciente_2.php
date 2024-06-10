<?php
require_once "../../models/Base_de_datos.php";
require_once "../../models/Paciente.php";
require_once "../../models/Medico.php";
require_once "../../models/Enfermero.php";
// Este controlador servira para cualquier vista que este después del inicio
session_start();
$nombre_usuario = $_SESSION['nombre_usuario'];
$usuario_objeto = $_SESSION['usuario_objeto'];
$usuario_puesto = $_SESSION['usuario_puesto'];

// Verifica si el usuario esta logueado
if (!isset($nombre_usuario)) {
    // Redirige a login.php si no existe el usuario
    $error = "Acceso restringido: Inicie sesión";
    header('Location: ../../views/b_login/login.php?error=' . urlencode($error));
    exit();
}else {
    // Guarda las variables en la sesión
    $_SESSION['nombre_usuario'] = $nombre_usuario;
    $_SESSION['usuario_objeto'] = $usuario_objeto;
    $_SESSION['usuario_puesto'] = $usuario_puesto;
}
// Verificar si el parámetro 'id' está presente en la URL
if (isset($_GET['id'])) {
    // Obtener el valor del parámetro 'id'
    $id = intval($_GET['id']);

    $base_de_datos = new Base_de_datos();
    // Datos paciente
    $registro = $base_de_datos->select("vista_paciente", "i", "pac_id_paciente", $id);
    $paciente_objeto = new Paciente($registro);
    $_SESSION['paciente_objeto'] = $paciente_objeto;
    $nombre_completo = htmlspecialchars($paciente_objeto->get_nombre_completo());
    $dni = htmlspecialchars($paciente_objeto->get_dni());
    $nombre = htmlspecialchars($paciente_objeto->get_nombre());
    $apellido = htmlspecialchars($paciente_objeto->get_apellido());
    $fecha_nacimiento = htmlspecialchars($paciente_objeto->get_fecha_nacimiento());
    $estatura = htmlspecialchars($paciente_objeto->get_estatura());
    $peso = htmlspecialchars($paciente_objeto->get_peso());
    $tipo_sangre = htmlspecialchars($paciente_objeto->get_tipo_sangre());
    $sexo = htmlspecialchars($paciente_objeto->get_sexo());
    $blob = file_get_contents($paciente_objeto->get_qr());
    $edad = htmlspecialchars($registro['per_edad']);
    $imc = htmlspecialchars($registro['per_imc']);
	$base64 = base64_encode($blob);

    // Datos de los últimos dos movimientos del paciente
    $base_de_datos = new Base_de_datos();
    $movimientos = $base_de_datos->select("movimiento", "i", "pac_id_paciente", $id, true, "mov_fecha_movimiento DESC");
    $fecha_alta = "";
    $fecha_baja = "";
    $descripcion_alta = "";
    $descripcion_baja = "";
    $contador = 0;
    // Obtener solo los dos primeros registros
    $primeros_movimientos = array_slice($movimientos, 0, 2);
    foreach ($primeros_movimientos as $movimiento)
    {
        $fecha_alta_aux = htmlspecialchars($movimiento['mov_fecha_alta']);
        $fecha_baja_aux = htmlspecialchars($movimiento['mov_fecha_baja']);
        // Procesar solo los dos primeros registros
        if ($fecha_alta_aux != null) {
            $descripcion_alta = htmlspecialchars($movimiento['mov_descripcion']);
            $fecha_alta = $fecha_alta_aux;
        }
        if ($fecha_baja_aux != null && $contador==0) {
            $descripcion_baja = htmlspecialchars($movimiento['mov_descripcion']);
            $fecha_baja = $fecha_baja_aux;
        }
        // Incrementar el contador
        $contador++;
    }

    // Obtener todos los datos relacionados con el paciente
    $base_de_datos = new Base_de_datos();
    
    $lista_tratamientos_actuales = $base_de_datos->select_simple("vista_tratamientos_activos", "pac_id_paciente", $id, "i", "*");
    $lista_tratamientos_actuales = $lista_tratamientos_actuales->get_result();
    $lista_tratamientos_actuales = $lista_tratamientos_actuales->fetch_all(MYSQLI_ASSOC);
    
    $lista_enfermedades_actuales = $base_de_datos->select_simple("vista_enfermedades_activas", "pac_id_paciente", $id, "i", "*");
    $lista_enfermedades_actuales = $lista_enfermedades_actuales->get_result();
    $lista_enfermedades_actuales = $lista_enfermedades_actuales->fetch_all(MYSQLI_ASSOC);
    
    $lista_antecedentes = $base_de_datos->select_simple("vista_antecedentes", "pac_id_paciente", $id, "i", "*");
    $lista_antecedentes = $lista_antecedentes->get_result();
    $lista_antecedentes = $lista_antecedentes->fetch_all(MYSQLI_ASSOC);
    
    $lista_tratamientos_finalizados = $base_de_datos->select_simple("vista_tratamientos_inactivos", "pac_id_paciente", $id, "i", "*");
    $lista_tratamientos_finalizados = $lista_tratamientos_finalizados->get_result();
    $lista_tratamientos_finalizados = $lista_tratamientos_finalizados->fetch_all(MYSQLI_ASSOC);

    $lista_enfermedades_finalizadas = $base_de_datos->select_simple("vista_enfermedades_inactivas", "pac_id_paciente", $id, "i", "*");
    $lista_enfermedades_finalizadas = $lista_enfermedades_finalizadas->get_result();
    $lista_enfermedades_finalizadas = $lista_enfermedades_finalizadas->fetch_all(MYSQLI_ASSOC);

    $lista_fichas_medicas = $base_de_datos->select_simple("vista_fichas_medicas", "pac_id_paciente", $id, "i", "*");
    $lista_fichas_medicas = $lista_fichas_medicas->get_result();
    $lista_fichas_medicas = $lista_fichas_medicas->fetch_all(MYSQLI_ASSOC);

    $base_de_datos->cerrar_conexion();
    
} else {
    // Si el parámetro 'id' no está presente en la URL, puedes manejar el error, redirigir, etc.
    echo "No se ha proporcionado un ID de paciente.";
}