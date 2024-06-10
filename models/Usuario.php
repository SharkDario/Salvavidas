<?php
require_once 'Base_de_datos.php';
require_once 'Persona.php';
abstract class Usuario extends Persona {
    private $usu_id_usuario;
    private $usu_usuario;
    private $usu_contrasenna;
    private $usu_matricula;
    private $usu_fecha_inicio_actividad;

    // Constructor para un Usuario Nuevo
    public function __construct($datos_usuario) {
        // Se crea la persona
        parent::__construct($datos_usuario);
        // Extrae los valores del arreglo asociativo
        $usu_usuario = $datos_usuario["usu_usuario"] ?? null;
        $usu_contrasenna = $datos_usuario["usu_contrasenna"] ?? null;
        $usu_matricula = $datos_usuario["usu_matricula"] ?? null;
        $usu_fecha_inicio_actividad = $datos_usuario["usu_fecha_inicio_actividad"] ?? null;
        $registro_nuevo = $datos_usuario["registro_nuevo"] ?? false;

        // Se asignan los valores a los atributos
        $this->usu_usuario = $usu_usuario;
        $hash = password_hash($usu_contrasenna, PASSWORD_DEFAULT);
        $this->usu_contrasenna = $hash;
        $this->usu_matricula = $usu_matricula;
        $this->usu_fecha_inicio_actividad = $usu_fecha_inicio_actividad;

        $base_de_datos = new Base_de_datos();
        if ($registro_nuevo) {
            // Si es un registro nuevo se procede a preparar la consulta INSERT
            // Consultas Preparadas - Prepared Statements stmt 
            // MySQL espera el formato 'YYYY-MM-DD HH:MM:SS' en Datetime
            $nombre_columnas = array("usu_usuario", "usu_contrasenna", "usu_matricula", "usu_fecha_inicio_actividad");
            $atributos_valores = array($usu_usuario, $hash, $usu_matricula, $usu_fecha_inicio_actividad);
            $this->usu_id_usuario = $base_de_datos->insert("usuario", $nombre_columnas, "ssis", $atributos_valores);
        }
        else {
            // En el caso de un registro ya guardado anteriormente, en el diccionario ya se tiene el usu_id_usuario
            $this->usu_id_usuario = $datos_usuario["usu_id_usuario"];
        }
    }

    public function get_id_usuario() {
        return $this->usu_id_usuario;
    }
    public function get_fecha_inicio_actividad() { return $this->usu_fecha_inicio_actividad; }
    public function get_usuario() {return $this->usu_usuario;}
    public function get_contrasenna() {return $this->usu_contrasenna;}
    public function get_matricula() {return $this->usu_matricula;}

    public function set_fecha_inicio_actividad($fecha) {
        $this->usu_fecha_inicio_actividad = $fecha;
        $base_de_datos = new Base_de_datos();
        $base_de_datos->update("usuario", "usu_fecha_inicio_actividad", "si", $fecha, "usu_id_usuario", $this->usu_id_usuario);
    }
    public function set_usuario($usuario) {
        $this->usu_usuario = $usuario;
        $base_de_datos = new Base_de_datos();
        $base_de_datos->update("usuario", "usu_usuario", "si", $usuario, "usu_id_usuario", $this->usu_id_usuario);
    }
    public function set_contrasenna($contrasenna){
        $this->usu_contrasenna = $contrasenna;
        $base_de_datos = new Base_de_datos();
        $hash = password_hash($contrasenna, PASSWORD_DEFAULT);
        $base_de_datos->update("usuario", "usu_contrasenna", "si", $hash, "usu_id_usuario", $this->usu_id_usuario);
    }
    public function set_matricula($matricula){
        $this->usu_matricula = $matricula;
        $base_de_datos = new Base_de_datos();
        $base_de_datos->update("usuario", "usu_matricula", "ii", $matricula, "usu_id_usuario", $this->usu_id_usuario);
    }

}