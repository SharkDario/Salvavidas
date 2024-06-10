<?php
// Este controlador servira para cualquier vista que este después del inicio
session_start();
require_once __DIR__ . '/../models/Base_de_datos.php';
require_once __DIR__ . '/../models/Paciente.php';
require_once __DIR__ . '/../models/Medico.php';
require_once __DIR__ . '/../models/Enfermero.php';

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