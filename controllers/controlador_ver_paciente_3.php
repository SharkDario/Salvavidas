<?php
require_once __DIR__ . '/../models/Paciente.php';
require_once __DIR__ . '/../models/Persona.php';
require_once __DIR__ . '/../models/Medico.php';
require_once __DIR__ . '/../models/Enfermero.php';
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
    $_SESSION['paciente_objeto'] = $paciente_objeto;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// Verificar qué botón fue apretado
    if (isset($_POST['modificar_paciente'])) {
        // El botón "MODIFICAR PACIENTE" fue presionado
        // Obtener los valores enviados del formulario
        $dni = $_POST['dni'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $fecha_nacimiento = $_POST['fecha_nacimiento'];
        $estatura = $_POST['estatura'];
        $peso = $_POST['peso'];
        $sexo = $_POST['sexo'];
        $tipo_sangre = $_POST['tipo_sangre'];

        $mensaje = "";
        // Comparar y actualizar si hay cambios
        if ($dni != $paciente_objeto->get_dni()) {
            $base_de_datos = new Base_de_datos();
            $array_dni = $base_de_datos->select("vista_paciente", "i", "per_dni", $dni);
            if ($array_dni != array()) {
                $mensaje = "El DNI ingresado ya existe.<br>";
            }
            if ((strlen($dni) != 8) && (preg_match('/\d{8}/', $dni) != true)) {
                $mensaje .= "El DNI debe tener 8 dígitos númericos.<br>";
            }
            if(trim($mensaje)==="") {
                $mensaje = "El DNI ha sido modificado.<br>";
                $paciente_objeto->set_dni($dni);
            }
            else {
                $dni = $paciente_objeto->get_dni();
            }
        }

        if ($nombre != $paciente_objeto->get_nombre()) {
            $mensaje .= "El nombre ha sido modificado.<br>";
            $paciente_objeto->set_nombre($nombre);
        }

        if ($apellido != $paciente_objeto->get_apellido()) {
            $mensaje .= "El apellido ha sido modificado.<br>";
            $paciente_objeto->set_apellido($apellido);
        }

        if ($fecha_nacimiento != $paciente_objeto->get_fecha_nacimiento()) {
            $fecha_actual = date('Y-m-d H:i:s'); // Obtiene la fecha actual en formato Y-m-d
            $timestampComparar = strtotime($fecha_nacimiento);
            $timestampActual = strtotime($fecha_actual);
            if ($timestampComparar >= $timestampActual) {
                $mensaje .= "La fecha de nacimiento debe ser menor a la fecha actual.<br>";
                $fecha_nacimiento = $paciente_objeto->get_fecha_nacimiento();
            }
            else {
                $mensaje .= "La fecha de nacimiento ha sido modificada.<br>";
                $paciente_objeto->set_fecha_nacimiento($fecha_nacimiento);
            }
        }

        if ($estatura != $paciente_objeto->get_estatura()) {
            if ($estatura <= 0) {
                $mensaje .= "La estatura debe ser positiva.<br>";
            } else {
                $mensaje .= "La estatura ha sido modificada.<br>";
                $paciente_objeto->set_estatura($estatura);
            }
            
        }

        if ($peso != $paciente_objeto->get_peso()) {
            if ($peso <= 0) {
                $mensaje .= "El peso debe ser positivo.<br>";
            } else {
                $mensaje .= "El peso ha sido modificado.<br>";
                $paciente_objeto->set_peso($peso);
            }
        }

        if ($sexo != $paciente_objeto->get_sexo()) {
            $mensaje .= "El sexo ha sido modificado.<br>";
            $paciente_objeto->set_sexo($sexo);
        }

        if ($tipo_sangre != $paciente_objeto->get_tipo_sangre()) {
            $mensaje .= "El tipo de sangre ha sido modificado.<br>";
            $paciente_objeto->set_tipo_sangre($tipo_sangre);
        }

        $paciente_id = $paciente_objeto->get_id_paciente();
        // Redirigir a la vista ver_paciente.php con el ID del paciente en la URL
        if(trim($mensaje)==="") {
            $mensaje = "No se han realizado modificaciones al paciente.";
        }
        header('Location: ./../views/g_ver_paciente/ver_paciente.php?id=' . urlencode($paciente_id) . '&mensaje=' . urlencode($mensaje));
        exit();
    } elseif (isset($_POST['annadir_ficha'])) {
        // El botón "AÑADIR FICHA MÉDICA" fue presionado
        $paciente_id = $paciente_objeto->get_id_paciente();
        header('Location: ./../views/h_annadir_ficha_medica/annadir_ficha_medica.php?id=' . urlencode($paciente_id));
        exit();
    } elseif (isset($_POST['annadir_seg'])) {
        // El botón "AÑADIR SEGUIMIENTO" fue presionado
        $paciente_id = $paciente_objeto->get_id_paciente();
        header('Location: ./../views/k_annadir_seguimiento/annadir_seguimiento.php?id=' . urlencode($paciente_id));
        exit();
    } else {
        // Ningún botón fue presionado
        echo "Ningún botón conocido fue presionado";
    }
}