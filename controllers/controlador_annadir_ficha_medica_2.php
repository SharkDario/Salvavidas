<?php
// Este controlador servira para cualquier vista que este después del inicio
session_start();
// Establece el encabezado de respuesta a JSON
//header('Content-Type: application/json');
require_once __DIR__ . '/../models/Base_de_datos.php';
require_once __DIR__ . '/../models/Paciente.php';
require_once __DIR__ . '/../models/Medico.php';
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

// $nombre_usuario Con esto puedo crear otra vez el medico
$base_de_datos = new Base_de_datos();
$registro = $base_de_datos->select("vista_medico", "s", "usu_usuario", $nombre_usuario);
$medico = new Medico($registro);

$medper_id_medico = $medico->get_id_medico();
$fic_fecha_ficha = $_POST['fecha_ficha'];
$pac_id_paciente = htmlspecialchars($_POST['paciente_id']);
$pac_id_paciente = (int)$pac_id_paciente;

// Obtener el JSON desde el campo oculto 'data'
$jsonData = $_POST['data'];

$data = json_decode($jsonData, true);

$enfermedades_array = $data['enfermedades'] ?? [];
$tratamientos_array = $data['tratamientos'] ?? [];
$antecedentes_array = $data['antecedentes'] ?? [];


if ($enfermedades_array!=[] || $tratamientos_array!=[] || $antecedentes_array!=[]) {
    // Las listas tienen contenido
    $base_de_datos = new Base_de_datos();
    $nombres_columnas = array("fic_fecha_ficha", "medper_id_medico", "pac_id_paciente");
    $atributos_valores = array($fic_fecha_ficha, $medper_id_medico, $pac_id_paciente);
    $fic_id_ficha = $base_de_datos->insert("ficha_medica", $nombres_columnas, "sii", $atributos_valores);

    $fecha_hoy = date('Y-m-d H:i:s');

    // Iterando sobre el array
    foreach ($enfermedades_array as $enfermedad) {
        // Acceder a los campos de cada enfermedad
        $enfgen_id_enfermedad = $enfermedad['nombre'];
        $movenf_fecha_inicio = $enfermedad['fechaInicio'];
        $enf_descripcion = $enfermedad['descripcion'];
        $enf_nivel_gravedad = $enfermedad['nivel'];
        $movenf_fecha_fin = !empty($enfermedad['fechaFin']) ? $enfermedad['fechaFin'] : null;
        $movenf_resultado = $enfermedad['resultado'];
        $movenf_fecha_movimiento = $fecha_hoy;
        

        $sintomas_array = $enfermedad['sintomas'];

        $base_de_datos = new Base_de_datos();

        $enf_id_enfermedad = $base_de_datos->insert_enfermedad_trigger($fic_id_ficha, $movenf_fecha_inicio, $movenf_fecha_fin, $movenf_resultado, $movenf_fecha_movimiento, $enf_nivel_gravedad, $enf_descripcion, $enfgen_id_enfermedad);
        foreach ($sintomas_array as $sintoma) {
            $base_de_datos = new Base_de_datos();
            $sin_id_sintoma = $sintoma['nombre'];
            $enfsin_fecha_inicio = $sintoma['fechaInicio']; 
            $enfsin_frecuencia = $sintoma['frecuencia'];

            $nombres_columnas = array("enf_id_enfermedad", "sin_id_sintoma", "enfsin_fecha_inicio", "enfsin_frecuencia");
            $atributos_valores = array($enf_id_enfermedad, $sin_id_sintoma, $enfsin_fecha_inicio, $enfsin_frecuencia);

            $base_de_datos->insert("enfermedad_tiene_sintoma", $nombres_columnas, "iiss", $atributos_valores);
        }
    }
    // Iterando sobre el array
    foreach ($antecedentes_array as $antecedente) {
        // Acceder a los campos de cada antecedente
        $antgen_id_antecedente = $antecedente['nombre'];
        $movant_fecha_inicio = $antecedente['fechaInicio'];
        $ant_frecuencia = $antecedente['frecuencia'];
        $movant_fecha_fin = !empty($antecedente['fechaFin']) ? $antecedente['fechaFin'] : null;
        $movant_resultado = $antecedente['resultado'];
        $movant_fecha_movimiento = $fecha_hoy;
        
        $base_de_datos = new Base_de_datos();

        $ant_id_antecedente = $base_de_datos->insert_antecedente_trigger($fic_id_ficha, $movant_fecha_inicio, $movant_fecha_fin, $movant_resultado, $movant_fecha_movimiento, $ant_frecuencia, $antgen_id_antecedente);
    }
    // Iterando sobre el array
    foreach ($tratamientos_array as $tratamiento) {
        // Acceder a los campos de cada tratamiento
        $tragen_id_tratamiento = $tratamiento['nombre'];
        $movtra_fecha_inicio = $tratamiento['fechaInicio'];
        $tra_descripcion = $tratamiento['descripcion'];
        $movtra_fecha_fin = !empty($tratamiento['fechaFin']) ? $tratamiento['fechaFin'] : null;
        $movtra_resultado = $tratamiento['resultado'];
        $movtra_fecha_movimiento = $fecha_hoy;
        

        $medicamentos_array = $tratamiento['medicamentos'];

        $base_de_datos = new Base_de_datos();

        $tra_id_tratamiento = $base_de_datos->insert_tratamiento_trigger($fic_id_ficha, $movtra_fecha_inicio, $movtra_fecha_fin, $movtra_resultado, $movtra_fecha_movimiento, $tra_descripcion, $tragen_id_tratamiento);
        
        foreach ($medicamentos_array as $medicamento) {
            $base_de_datos = new Base_de_datos();

            $medgen_id_medicamento = $medicamento['nombre'];
            $med_frecuencia = $medicamento['frecuencia']; 
            $med_dosis = $medicamento['dosis'];
            $med_indicacion = $medicamento['indicacion'];
            $med_via_transmision = $medicamento['via'];
            $med_marca = $medicamento['marca'];
            	

            $nombres_columnas = array("med_frecuencia", "med_dosis", "med_indicacion", "med_via_transmision", "med_marca", "medgen_id_medicamento");
            $atributos_valores = array($med_frecuencia, $med_dosis, $med_indicacion, $med_via_transmision, $med_marca, $medgen_id_medicamento);

            $med_id_medicamento = $base_de_datos->insert("medicamento", $nombres_columnas, "sdsssi", $atributos_valores);
            
            $base_de_datos = new Base_de_datos();
            $nombres_columnas = array("med_id_medicamento", "tra_id_tratamiento");
            $atributos_valores = array($med_id_medicamento, $tra_id_tratamiento);
            $base_de_datos->insert("tratamiento_tiene_medicamento", $nombres_columnas, "ii", $atributos_valores);
        }
    }
    $mensaje = "¡La ficha médica se ha añadido con éxito!";
}
else{
    // Mandar un mensaje de error que al menos un cambio se debe hacer
    $mensaje = "Error: debe añadir al menos una enfermedad, un tratamiento o un antecedente.";
}
//echo $mensaje;
header('Location: ./../views/h_annadir_ficha_medica/annadir_ficha_medica.php?id=' . urlencode($pac_id_paciente) . '&mensaje=' . urlencode($mensaje));
exit();
