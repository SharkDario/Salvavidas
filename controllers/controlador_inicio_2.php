<?php

session_start();
require_once __DIR__ . '/../models/Base_de_datos.php';
require_once __DIR__ . '/../models/Paciente.php';
require_once __DIR__ . '/../models/Medico.php';
require_once __DIR__ . '/../models/Enfermero.php';

$nombre_usuario = $_SESSION['nombre_usuario']; // Recuperar los valores de las variables ocultas
$usuario_objeto = $_SESSION['usuario_objeto'];
$usuario_puesto = $_SESSION['usuario_puesto'];

// Verifica si el usuario esta logueado
if (!isset($nombre_usuario)) {
    // Redirige a login.php si no existe el usuario
    $error = "Acceso restringido: Inicie sesión";
    header('Location: ../views/b_login/login.php?error=' . urlencode($error));
    exit();
} else {
    // Guarda las variables en la sesión
    $_SESSION['nombre_usuario'] = $nombre_usuario;
    $_SESSION['usuario_objeto'] = $usuario_objeto;
    $_SESSION['usuario_puesto'] = $usuario_puesto;
}

if (isset($_POST['escanear_qr'])) {
    header('Location: ../views/f_escaner_QR/escanear_qr.php');
    exit();
} elseif (isset($_POST['lista_pacientes'])) {
    header('Location: ../views/e_lista_de_pacientes/lista_pacientes.php');
    exit();
} elseif (isset($_POST['registrar_paciente'])) {
    header('Location: ../views/d_registro_paciente/registro_paciente.php');
    exit();
} elseif (isset($_POST['lista_epicrisis'])) {
    header('Location: ../views/j_lista_de_epicrisis/lista_epicrisis.php');
    exit();
} elseif (isset($_POST['analisis'])) {
    header('Location: ../views/z_analisis/z_analisis.php');
    exit();
} else {
    //agregar_seguimiento
}