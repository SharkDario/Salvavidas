<?php
require_once 'Base_de_datos.php';
abstract class Persona {
    private $per_id_persona;
    private $per_nombre;
    private $per_apellido;
    private $per_sexo;
    private $per_dni;
    private $per_fecha_nacimiento;
    private $per_tipo_sangre;

    // Constructor para una persona nueva
    public function __construct($datos_persona) {
        // Extrae los valores del arreglo asociativo
        $per_nombre = $datos_persona["per_nombre"] ?? null;
        $per_apellido = $datos_persona["per_apellido"] ?? null;
        $per_sexo = $datos_persona["per_sexo"] ?? null;
        $per_dni = $datos_persona["per_dni"] ?? null;
        $per_fecha_nacimiento = $datos_persona["per_fecha_nacimiento"] ?? null;
        $per_tipo_sangre = $datos_persona["per_tipo_sangre"] ?? null;
        $registro_nuevo = $datos_persona["registro_nuevo"] ?? false;

        // Se asignan los valores a los atributos
        $this->per_nombre = $per_nombre;
        $this->per_apellido = $per_apellido;
        $this->per_sexo = $per_sexo;
        $this->per_dni = $per_dni;
        $this->per_fecha_nacimiento = $per_fecha_nacimiento;
        $this->per_tipo_sangre = $per_tipo_sangre;

        if ($registro_nuevo) {
            $base_de_datos = new Base_de_datos();
            // Si es un registro nuevo se procede a preparar la consulta INSERT
            // Consultas Preparadas - Prepared Statements stmt 
            // MySQL espera el formato 'YYYY-MM-DD HH:MM:SS' en Datetime
            $nombre_columnas = array("per_nombre", "per_apellido", "per_sexo", "per_dni", "per_fecha_nacimiento", "per_tipo_sangre");
            $atributos_valores = array($per_nombre, $per_apellido, $per_sexo, $per_dni, $per_fecha_nacimiento, $per_tipo_sangre);
            $this->per_id_persona = $base_de_datos->insert("persona", $nombre_columnas, "sssiss", $atributos_valores);
        } else {
            // En el caso de un registro ya guardado anteriormente, en el diccionario ya se tiene el per_id_persona
            $this->per_id_persona = $datos_persona["per_id_persona"];
        }
    }

    public function get_id_persona()
    {
        return $this->per_id_persona;
    }

    public function get_nombre(){ return $this->per_nombre; }
    public function get_apellido(){ return $this->per_apellido; }
    public function get_sexo(){ return $this->per_sexo; }
    public function get_dni(){ return $this->per_dni; }
    public function get_fecha_nacimiento(){return $this->per_fecha_nacimiento; }
    public function get_tipo_sangre(){  return $this->per_tipo_sangre; }

    public function get_nombre_completo(){
        $nombre_completo = $this->per_nombre . " " . $this->per_apellido;
        return $nombre_completo;
    }

    public function set_nombre($nombre){ 
        $this->per_nombre = $nombre;
        $base_de_datos = new Base_de_datos();
        $base_de_datos->update("persona", "per_nombre", "si", $nombre, "per_id_persona", $this->per_id_persona);
    }
    public function set_apellido($per_apellido){ 
        $this->per_apellido = $per_apellido;
        $base_de_datos = new Base_de_datos();
        $base_de_datos->update("persona", "per_apellido", "si", $per_apellido, "per_id_persona", $this->per_id_persona);
    }
    public function set_sexo($sexo){
        $this->per_sexo = $sexo;
        $base_de_datos = new Base_de_datos();
        $base_de_datos->update("persona", "per_sexo", "si", $sexo, "per_id_persona", $this->per_id_persona);
    }
    public function set_dni($dni){
        $this->per_dni = $dni;
        $base_de_datos = new Base_de_datos();
        $base_de_datos->update("persona", "per_dni", "ii", $dni, "per_id_persona", $this->per_id_persona);
    }
    public function set_fecha_nacimiento($fecha_nacimiento){
        $this->per_fecha_nacimiento = $fecha_nacimiento;
        $base_de_datos = new Base_de_datos();
        $base_de_datos->update("persona", "per_fecha_nacimiento", "si", $fecha_nacimiento, "per_id_persona", $this->per_id_persona);
    }
    public function set_tipo_sangre($tipo_sangre){
        $this->per_tipo_sangre = $tipo_sangre;
        $base_de_datos = new Base_de_datos();
        $base_de_datos->update("persona", "per_tipo_sangre", "si", $tipo_sangre, "per_id_persona", $this->per_id_persona);
    }
}