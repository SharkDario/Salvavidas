<?php
session_start();
require "../../models/Base_de_datos.php";
require "../../models/Enfermero.php";
require "../../models/Medico.php";

$usu_usuario = $_SESSION['usuario'];

// Verifica si el usuario esta logueado
if (!isset($usu_usuario)) {
    // Redirige a login.php si no existe el usuario
    $error = "Acceso restringido: Inicie sesión";
    header('Location: ../b_login/login.php?error=' . urlencode($error));
    exit();
}
$base_de_datos = new Base_de_datos();

$puesto_usuario = $base_de_datos->select("vista_puesto_usuario", "s", "nombre_usuario", $usu_usuario);

$base_de_datos = new Base_de_datos();
if ($puesto_usuario['puesto'] == "Médico") {
    $registro = $base_de_datos->select("vista_medico", "s", "usu_usuario", $usu_usuario);
    $usuario = new Medico($registro);
} else {
    $registro = $base_de_datos->select("vista_enfermero", "s", "usu_usuario", $usu_usuario);
    $usuario = new Enfermero($registro);
}
$_SESSION['nombre_usuario'] = $usu_usuario;
$_SESSION['usuario_objeto'] = $usuario;
$_SESSION['usuario_puesto'] = $puesto_usuario;