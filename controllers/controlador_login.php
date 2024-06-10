<?php
session_start();
require_once '../models/Base_de_datos.php';

$usuario = trim($_POST['usuario']);
$contrasena_ingresada = trim($_POST['contrasenna']);

// Conectarse a la base de datos
$base_de_datos = new Base_de_datos();


// Sanitizar la entrada del usuario
$usuario_sanitizado = $base_de_datos->obtener_conexion()->real_escape_string($usuario);

// Consulta para obtener el hash de la contraseña
$resultado = $base_de_datos->select_simple("usuario", "usu_usuario", $usuario_sanitizado, "s", "usu_contrasenna");

$resultado->store_result(); // Necesario para usar num_rows

if ($resultado->num_rows > 0) {
    $resultado->bind_result($contrasena_hash);
    $resultado->fetch();

    // Verificar la contraseña ingresada
    if (password_verify($contrasena_ingresada, $contrasena_hash)) {
        // Contraseña correcta, iniciar sesión del usuario
        //echo "Usuario y contraseña\ncorrectos. ¡Bienvenido!";
        // Iniciar sesión (por ejemplo, crear una sesión)
        
        $_SESSION['usuario'] = $usuario_sanitizado;
        header('Location: ../views/c_pantalla_de_inicio/inicio.php'); // Redirigir a la página principal
        $base_de_datos->cerrar_conexion();
        exit();
    } else {
        // Contraseña incorrecta
        $error = "Usuario y/o contraseña incorrectos.";
    }
} else {
    // Error en la consulta o usuario no encontrado
    $error = "Usuario y/o contraseña incorrectos.";
}
$resultado->close();
// Cerrar la conexión a la base de datos
$base_de_datos->cerrar_conexion();

// Mostrar el error en la página de inicio de sesión
header('Location: ../views/b_login/login.php?error=' . urlencode($error));
exit();