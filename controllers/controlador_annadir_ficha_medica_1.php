<?php
// Este controlador servira para cualquier vista que este después del inicio
session_start();
require_once __DIR__ . '/../models/Base_de_datos.php';
require_once __DIR__ . '/../models/Paciente.php';
require_once __DIR__ . '/../models/Medico.php';
$nombre_usuario = $_SESSION['nombre_usuario'];
$usuario_objeto = $_SESSION['usuario_objeto'];
$usuario_puesto = $_SESSION['usuario_puesto'];
$paciente_objeto = $_SESSION['paciente_objeto'];

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
    $_SESSION['paciente_objeto'] = $paciente_objeto;
}
// Aquí tengo que recuperar los datos de la BD
$base_de_datos = new Base_de_datos();
$campos = "*";
$lista_tipo_enfermedad = $base_de_datos->select_all("vista_tipo_enfermedad", $campos, false);

$lista_enfermedades_genericas = $base_de_datos->select_all("vista_enfermedad_generica", $campos, false);

$lista_sintomas = $base_de_datos->select_all("vista_sintoma", $campos, false);

$lista_tipo_tratamiento = $base_de_datos->select_all("vista_tipo_tratamiento", $campos, false);

$lista_tratamientos_genericos = $base_de_datos->select_all("vista_tratamiento_generico", $campos, false);

$lista_medicamentos_genericos = $base_de_datos->select_all("vista_medicamento_generico", $campos, false);

$lista_antecedentes_genericos = $base_de_datos->select_all("vista_antecedente_generico", $campos, false);

$base_de_datos->cerrar_conexion();
