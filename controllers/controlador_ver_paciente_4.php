<?php
require_once __DIR__ . '/../models/Paciente.php';
require_once __DIR__ . '/../models/Persona.php';
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../models/Medico.php';
require_once __DIR__ . '/../models/Base_de_datos.php';
// Este controlador servira para cualquier vista que este después del inicio
session_start();
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
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// Verificar qué botón fue apretado
    if (isset($_POST['egresa'])) {
        // El botón "CONFIRMAR" de salida de terapia
        // Obtener los valores enviados del formulario
        $fecha_baja = $_POST['fecha_baja_mod'];
        $descripcion = $_POST['descripcion_baja_mod'];
        $mensaje = "";
        $fecha_alta_ultima = $_POST['fecha_alta'];
        
        $timestampComparar = strtotime($fecha_alta_ultima);
        $timestampActual = strtotime($fecha_baja);
        if ($timestampComparar >= $timestampActual) {
            $mensaje .= "La última fecha de ingreso debe ser menor a la fecha de egreso.<br>";
        }
        else {
            $mensaje .= "El paciente ha egresado de terapia en la fecha " . $fecha_baja . ".<br>";
            $fecha_actual = date('Y-m-d H:i:s'); // Obtiene la fecha actual en formato Y-m-d
            $base_de_datos = new Base_de_datos();
            $nombre_columnas = array("pac_id_paciente", "usu_id_usuario", "mov_fecha_baja", "mov_descripcion", "mov_fecha_movimiento");
            $atributos_valores = array($paciente_objeto->get_id_paciente(), $usuario_objeto->get_id_usuario(), $fecha_baja, $descripcion, $fecha_actual);
            $movimiento_id = $base_de_datos->insert("movimiento", $nombre_columnas, "iisss", $atributos_valores);
        }
        $paciente_id = $paciente_objeto->get_id_paciente();
        // Redirigir a la vista ver_paciente.php con el ID del paciente en la URL
        header('Location: ./../views/g_ver_paciente/ver_paciente.php?id=' . urlencode($paciente_id) . '&mensaje=' . urlencode($mensaje));
        exit();

    } elseif (isset($_POST['ingresa'])) {
        // El botón "CONFIRMAR" de entrada a terapia
        // Obtener los valores enviados del formulario
        $fecha_alta = $_POST['fecha_alta_mod'];
        $descripcion = $_POST['descripcion_alta_mod'];
        $mensaje = "";
        $fecha_baja_ultima = $_POST['fecha_baja'];
        
        $timestampComparar = strtotime($fecha_baja_ultima);
        $timestampActual = strtotime($fecha_alta);
        if ($timestampComparar >= $timestampActual) {
            $mensaje .= "La última fecha de egreso debe ser menor a la fecha de ingreso.<br>";
        }
        else {
            $mensaje .= "El paciente ha ingresado a terapia en la fecha " . $fecha_alta . ".<br>";
            $fecha_actual = date('Y-m-d H:i:s'); // Obtiene la fecha actual en formato Y-m-d
            $base_de_datos = new Base_de_datos();
            $nombre_columnas = array("pac_id_paciente", "usu_id_usuario", "mov_fecha_alta", "mov_descripcion", "mov_fecha_movimiento");
            $atributos_valores = array($paciente_objeto->get_id_paciente(), $usuario_objeto->get_id_usuario(), $fecha_alta, $descripcion, $fecha_actual);
            $movimiento_id = $base_de_datos->insert("movimiento", $nombre_columnas, "iisss", $atributos_valores);
        }
        $paciente_id = $paciente_objeto->get_id_paciente();
        // Redirigir a la vista ver_paciente.php con el ID del paciente en la URL
        header('Location: ./../views/g_ver_paciente/ver_paciente.php?id=' . urlencode($paciente_id) . '&mensaje=' . urlencode($mensaje));
        exit();
    } else {
        // Ningún botón fue presionado
        echo "Ningún botón conocido fue presionado";
    }
}