<?php
require_once "../../models/Base_de_datos.php";
require_once "../../models/Paciente.php";
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
	$base64 = base64_encode($blob);

    // Datos de los últimos dos movimientos del paciente
    $base_de_datos = new Base_de_datos();
    $movimientos = $base_de_datos->select("movimiento", "i", "pac_id_paciente", $id, true);
    $fecha_alta = "";
    $fecha_baja = "";
    $descripcion_alta = "";
    $descripcion_baja = "";
    $contador = 0;
    // Obtener solo los dos primeros registros
    $primeros_movimientos = array_slice($movimientos, 0, 2);
    foreach ($primeros_movimientos as $movimiento)
    {
        // Procesar solo los dos primeros registros
        if ($contador == 0) {
            $fecha_alta = htmlspecialchars($movimiento['mov_fecha_alta']);
            $descripcion_alta = htmlspecialchars($movimiento['mov_descripcion']);
            if($fecha_alta==null){
                $fecha_baja = htmlspecialchars($movimiento['mov_fecha_baja']);
                $descripcion_baja = htmlspecialchars($movimiento['mov_descripcion']);
            }else{
                break;
            }
        }
        if ($contador == 1 && $fecha_alta == null) {
            $fecha_alta = htmlspecialchars($movimiento['mov_fecha_alta']);
            $descripcion_alta = htmlspecialchars($movimiento['mov_descripcion']);
        }
        // Incrementar el contador
        $contador++;
    }

    // Ejemplo de uso:
    // echo "ID del paciente: " . htmlspecialchars($id);
} else {
    // Si el parámetro 'id' no está presente en la URL, puedes manejar el error, redirigir, etc.
    echo "No se ha proporcionado un ID de paciente.";
}