<?php
class Base_de_datos {
    private $host = "localhost";
    private $usuario = "root";
    private $contrasena = "";
    private $base_datos = "bd_salvavidas";
    private $conexion;

    public function __construct() {
        $this->conexion = new mysqli($this->host, $this->usuario, $this->contrasena, $this->base_datos);

        if ($this->conexion->connect_error) {
            die("Error de conexión: " . $this->conexion->connect_error);
        }
    }

    public function obtener_conexion() {
        return $this->conexion;
    }

    public function cerrar_conexion() {
        $this->conexion->close();
    }
}
