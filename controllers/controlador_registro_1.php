<?php
require __DIR__ . '/../models/Medico.php';
require __DIR__ . '/../models/Paciente.php';
require __DIR__ . '/../models/Enfermero.php';
require_once __DIR__ . '/../models/Base_de_datos.php';

session_start();
$nombre_usuario = $_SESSION['nombre_usuario'];
$usuario_objeto = $_SESSION['usuario_objeto'];
$usuario_puesto = $_SESSION['usuario_puesto'];

// Verifica si el usuario esta logueado
if (!isset($nombre_usuario)) {
    // Redirige a login.php si no existe el usuario
    $error = "Acceso restringido: Inicie sesión";
    header('Location: ../b_login/login.php?error=' . urlencode($error));
    exit();
}else {
    // Guarda las variables en la sesión
    $_SESSION['nombre_usuario'] = $nombre_usuario;
    $_SESSION['usuario_objeto'] = $usuario_objeto;
    $_SESSION['usuario_puesto'] = $usuario_puesto;
}

// ejemplo de como se consiguen los datos de la sesion
//echo($nombre_usuario);
//echo($usuario_puesto['puesto']);
//echo($usuario_objeto->get_id_usuario());

$dni = $_POST['dni'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$estatura = $_POST['estatura'];
$peso = $_POST['peso'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$sexo = $_POST['sexo'];
$tipo_sangre = $_POST['tipo_sangre'];
$fecha_alta = $_POST['fecha_alta'];
$descripcion = $_POST['descripcion'];
$id_usuario = $usuario_objeto->get_id_usuario();

//Validaciones
//$dni (que sea entero de longitud 8-norepetir)
//$peso y $estatura deben ser positivos
//$fecha_nacimiento debe ser menor a la fecha "datetime" actual

//$registro_dni = $registros_dnis->fetch_all(MYSQLI_ASSOC);
$base_de_datos = new Base_de_datos();
$array_dni = $base_de_datos->select("vista_paciente", "i", "per_dni", $dni);

$fecha_actual = date('Y-m-d H:i:s'); // Obtiene la fecha actual en formato Y-m-d
$timestampComparar = strtotime($fecha_nacimiento);
$timestampActual = strtotime($fecha_actual);

$error="";
if($array_dni!=array()){
    $error = "El DNI ingresado ya existe.<br>";
}
if ((strlen($dni) != 8) && (preg_match('/\d{8}/', $dni)!=true)){
    $error .= "El DNI debe tener 8 dígitos númericos.<br>";
}
if ($timestampComparar >= $timestampActual){
    $error .= "La fecha de nacimiento debe ser menor a la fecha actual.<br>";
}
if($estatura<=0){
    $error .= "La estatura debe ser positiva.<br>";
}
if($peso<=0){
    $error .= "El peso debe ser positivo.<br>";
}

if(trim($error)===""){
    $registro = array(
        "per_nombre" => $nombre,
        "per_apellido" => $apellido,
        "per_sexo" => $sexo,
        "per_dni" => $dni,
        "per_fecha_nacimiento" => $fecha_nacimiento,
        "per_tipo_sangre" => $tipo_sangre,
        "pac_estatura" => $estatura,
        "pac_peso" => $peso,
        "usu_id_usuario" => $id_usuario,
        "mov_fecha_alta" => $fecha_alta,
        "mov_descripcion" => $descripcion,
        "mov_fecha_movimiento" => $fecha_actual,
        "registro_nuevo" => true
    );
    $paciente = new Paciente($registro);
    // Mostrar el exito del registro en la página de registro
    header('Location: ../views/d_registro_paciente/registro_paciente.php?exito=' . urlencode(""));
    exit();
} else {
    // Mostrar el error en la página de registro
    header('Location: ../views/d_registro_paciente/registro_paciente.php?error=' . urlencode(nl2br($error)));
    exit();
}