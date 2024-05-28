<?php
require_once 'Base_de_datos.php';
require_once 'Usuario.php';
class Enfermero extends Usuario
{
    private $enfper_id_enfermero;
    private $enfper_habilidad;

    // Constructor para un Medico Nuevo
    public function __construct($datos_usuario)
    {
        // Se crea el Usuario
        parent::__construct($datos_usuario);
        // Extrae los valores del arreglo asociativo
        $enfper_habilidad = $datos_usuario["enfper_habilidad"] ?? null;
        $registro_nuevo = $datos_usuario["registro_nuevo"] ?? false;

        // Se asignan los valores a los atributos
        $this->enfper_habilidad = $enfper_habilidad;

        if ($registro_nuevo) {
            $base_de_datos = new Base_de_datos();
            // Si es un registro nuevo se procede a preparar la consulta INSERT
            // Consultas Preparadas - Prepared Statements stmt 
            // MySQL espera el formato 'YYYY-MM-DD HH:MM:SS' en Datetime
            $usu_id_usuario = $this->get_id_usuario();
            $per_id_persona = $this->get_id_persona();
            $nombre_columnas = array("enfper_habilidad", "usu_id_usuario", "per_id_persona");
            $atributos_valores = array($enfper_habilidad, $usu_id_usuario, $per_id_persona);
            $this->enfper_id_enfermero = $base_de_datos->insert("enfermero", $nombre_columnas, "sii", $atributos_valores);
        } else {
            // En el caso de un registro ya guardado anteriormente, en el diccionario ya se tiene el enfper_id_enfermero
            $this->enfper_id_enfermero = $datos_usuario["enfper_id_enfermero"];
        }
    }

    public function get_id_enfermero()
    {
        return $this->enfper_id_enfermero;
    }

    public function get_habilidad()
    {
        return $this->enfper_habilidad;
    }

    public function get_nombre_completo()
    {
        $profesion = ($this->get_sexo() === "hombre") ? "enfermero " : "enfermera ";
        return $profesion . parent::get_nombre_completo();
    }

    public function set_habilidad($habilidad)
    {
        $this->enfper_habilidad = $habilidad;
        $base_de_datos = new Base_de_datos();
        $base_de_datos->update("enfermero", "enfper_habilidad", "si", $habilidad, "enfper_id_enfermero", $this->enfper_id_enfermero);
    }
}
/*
$arreglo_enfermero = array(
    "per_nombre" => "Victor",
    "per_apellido" => "Coronel",
    "per_sexo" => "hombre",
    "per_dni" => 74545454,
    "per_fecha_nacimiento" => "1998-08-07",
    "per_tipo_sangre" => "A+",
    "usu_usuario" => "Victor7",
    "usu_contrasenna" => "Dario013",
    "usu_matricula" => 77646464,
    "usu_fecha_inicio_actividad" => "2024-01-28",
    "enfper_habilidad" => "Monitorizacion",
    "registro_nuevo" => true
);

$enfermero = new Enfermero($arreglo_enfermero);
*/