<?php

session_start();
$nombre_usuario = $_SESSION['usuario']; // Recuperar los valores de las variables ocultas
$usuario_objeto = $_POST['usuario_objeto'];
$usuario_puesto = $_POST['usuario_puesto'];

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

} elseif (isset($_POST['registrar_paciente'])) {
    header('Location: ../views/d_registro_paciente/registro_paciente.php');
    exit();
} elseif (isset($_POST['lista_epicrisis'])) {

} elseif (isset($_POST['analisis'])) {

} else {
    //agregar_seguimiento
}