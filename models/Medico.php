<?php
require_once 'Base_de_datos.php';
require_once 'Usuario.php';
class Medico extends Usuario
{
    private $medper_id_medico;
    private $medper_especialidad;
    private $medper_annos_residencia;

    // Constructor para un Medico Nuevo
    public function __construct($datos_usuario)
    {
        // Se crea el Usuario
        parent::__construct($datos_usuario);
        // Extrae los valores del arreglo asociativo
        $medper_especialidad = $datos_usuario["medper_especialidad"] ?? null;
        $medper_annos_residencia = $datos_usuario["medper_annos_residencia"] ?? null;
        $registro_nuevo = $datos_usuario["registro_nuevo"] ?? false;

        // Se asignan los valores a los atributos
        $this->medper_especialidad = $medper_especialidad;
        $this->medper_annos_residencia = $medper_annos_residencia;

        
        if ($registro_nuevo) {
            $base_de_datos = new Base_de_datos();
            // Si es un registro nuevo se procede a preparar la consulta INSERT
            // Consultas Preparadas - Prepared Statements stmt 
            // MySQL espera el formato 'YYYY-MM-DD HH:MM:SS' en Datetime
            $usu_id_usuario = $this->get_id_usuario();
            $per_id_persona = $this->get_id_persona();
            $nombre_columnas = array("medper_especialidad", "medper_annos_residencia", "usu_id_usuario", "per_id_persona");
            $atributos_valores = array($medper_especialidad, $medper_annos_residencia, $usu_id_usuario, $per_id_persona);
            $this->medper_id_medico = $base_de_datos->insert("medico", $nombre_columnas, "siii", $atributos_valores);

        } else {
            // En el caso de un registro ya guardado anteriormente, en el diccionario ya se tiene el medper_id_medico
            $this->medper_id_medico = $datos_usuario["medper_id_medico"];
        }
    }

    public function get_id_medico()
    {
        return $this->medper_id_medico;
    }

    public function get_especialidad()
    {
        return $this->medper_especialidad;
    }
    public function get_annos_residencia()
    {
        return $this->medper_annos_residencia;
    }

    public function get_nombre_completo()
    {
        $profesion = ($this->get_sexo() === "hombre") ? "médico " : "médica ";
        return $profesion . parent::get_nombre_completo();
    }

    public function set_especialidad($especialidad)
    {
        $this->medper_especialidad = $especialidad;
        $base_de_datos = new Base_de_datos();
        $base_de_datos->update("medico", "medper_especialidad", "si", $especialidad, "medper_id_medico", $this->medper_id_medico);
    }
    public function set_annos_residencia($annos_residencia)
    {
        $this->medper_annos_residencia = $annos_residencia;
        $base_de_datos = new Base_de_datos();
        $base_de_datos->update("medico", "medper_annos_residencia", "ii", $annos_residencia, "medper_id_medico", $this->medper_id_medico);
    }
}

// Crear un arreglo asociativo
/*$arreglo_medico = array(
    "per_nombre" => "Azul",
    "per_apellido" => "Coronel",
    "per_sexo" => "mujer",
    "per_dni" => 44343434,
    "per_fecha_nacimiento" => "2003-08-14",
    "per_tipo_sangre" => "O+",
    "usu_usuario" => "Azul14",
    "usu_contrasenna" => "Azulyan1",
    "usu_matricula" => 34343434,
    "usu_fecha_inicio_actividad" => "2024-01-28",
    "medper_especialidad" => "Intensivista",
    "medper_annos_residencia" => 5,
    "registro_nuevo" => true
);

$medico = new Medico($arreglo_medico);

$arreglo_medico = array(
    "per_nombre" => "Dario",
    "per_apellido" => "Coronel",
    "per_sexo" => "hombre",
    "per_dni" => 54545454,
    "per_fecha_nacimiento" => "1998-08-07",
    "per_tipo_sangre" => "A+",
    "usu_usuario" => "Dario7",
    "usu_contrasenna" => "Dario013",
    "usu_matricula" => 64646464,
    "usu_fecha_inicio_actividad" => "2024-01-28",
    "medper_especialidad" => "Intensivista",
    "medper_annos_residencia" => 5,
    "registro_nuevo" => true
);
$medico = new Medico($arreglo_medico);



//Prueba de objeto de tipo Medico
$base_de_datos = new Base_de_datos();
$usu_usuario = "Azul14";
$registro = $base_de_datos->select("vista_medico", "s", "usu_usuario", $usu_usuario);

$medico = new Medico($registro);
print ($medico->get_id_persona());
print ($medico->get_id_medico());
print ($medico->get_nombre());
print ($medico->get_apellido());


*/