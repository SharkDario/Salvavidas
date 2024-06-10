<?php
session_start();
require "../../models/Base_de_datos.php";
require_once "../../models/Paciente.php";
require_once "../../models/Medico.php";
require_once "../../models/Enfermero.php";

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
// Aquí tengo que recuperar los datos de la BD
$base_de_datos = new Base_de_datos();
$campos = "última_fecha_egreso, per_dni, per_nombre, per_apellido, per_sexo, per_fecha_nacimiento, per_tipo_sangre, pac_estatura, pac_peso, pac_qr, pac_id_paciente";
$lista_pacientes = $base_de_datos->select_all("vista_paciente_inactivos", $campos);