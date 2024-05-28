<?php
session_start();
$usu_usuario = $_SESSION['usuario'];

// Verifica si el usuario esta logueado
if (!isset($usu_usuario)) {
    // Redirige a login.php si no existe el usuario
    $error = "Acceso restringido: Inicie sesión";
    header('Location: ../b_login/login.php?error=' . urlencode($error));
    exit();
}