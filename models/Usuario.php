<?php
require 'Base_de_datos.php';
abstract class Usuario {
    private $usu_id_usuario;
    private $usu_usuario;
    private $usu_contrasenna;
    private $usu_matricula;
    private $usu_fecha_inicio_actividad;

    // Constructor para un Usuario Nuevo
    public function __construct($usu_usuario, $usu_contrasenna, $usu_matricula, $usu_fecha_inicio_actividad) {
        $this->usu_usuario = $usu_usuario;
        $hash = password_hash($usu_contrasenna, PASSWORD_DEFAULT);
        $this->usu_contrasenna = $hash;
        $this->usu_matricula = $usu_matricula;
        $this->usu_fecha_inicio_actividad = $usu_fecha_inicio_actividad;
        $base_de_datos = new Base_de_datos();
        // Consultas Preparadas - Prepared Statements stmt 
        // MySQL espera el formato 'YYYY-MM-DD HH:MM:SS' en Datetime
        $stmt = $base_de_datos->obtener_conexion()->prepare("INSERT INTO usuario(usu_usuario, usu_contrasenna, usu_matricula, usu_fecha_inicio_actividad) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('ssis', $usu_usuario, $hash, $usu_matricula, $usu_fecha_inicio_actividad);
        $stmt->execute();
        // Recupera el id del usuario
        $this->usu_id_usuario = $base_de_datos->obtener_conexion()->insert_id;
        
        $base_de_datos->cerrar_conexion();
    }

    public static function objeto_guardado($usu_usuario, $usu_contrasenna) {
        //usuario = Usuario::objeto_guardado($usu_usuario, $usu_contrasenna);
        /*$objeto_usuario = new self();
        $objeto_usuario->usu_usuario = "";
        $objeto_usuario->usu_contrasenna = "";
        
        $objeto_usuario->usu_matricula = "";
        $objeto_usuario->usu_fecha_inicio_actividad = "";
        $objeto_usuario->usu_id_usuario = "";

        return $objeto_usuario;*/
    }

    public function get_id_usuario() {
        return $this->usu_id_usuario;
    }

    public function cr_con() {
        
    }
}


//$usuario = new Usuario("Azul14", "Azulyan1", 34343434,'2024-01-28');
