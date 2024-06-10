<?php
session_start();
require_once "../models/Base_de_datos.php";
require_once "../models/Paciente.php";
require_once "../models/Medico.php";
require_once "../models/Enfermero.php";
//require_once "../../models/Base_de_datos.php";
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


//if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['paciente_id'])) {
$paciente_id = htmlspecialchars($_POST['paciente_id']);

//$base_de_datos = new Base_de_datos();
//$paciente_registro = $base_de_datos->select("vista_paciente", "i", "pac_id_paciente", $paciente_id);

// Redirigir a la vista ver_paciente.php con el ID del paciente en la URL
header('Location: ./../views/g_ver_paciente/ver_paciente.php?id=' . urlencode($paciente_id));
exit();
