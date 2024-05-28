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

    public function insert($tabla, $nombres_columnas, $atributos_tipos, $atributos_valores)
    {
        // Los $valores estan en un array
        // $atributos_tipos = "ssii"
        $placeholders = implode(', ', array_fill(0, count($nombres_columnas), '?'));
        $consulta = "INSERT INTO $tabla (" . implode(', ', $nombres_columnas) . ") VALUES ($placeholders)";

        $stmt = $this->obtener_conexion()->prepare($consulta);
        $stmt->bind_param($atributos_tipos, ...$atributos_valores);
        $stmt->execute();
        $id_insertado = $this->obtener_conexion()->insert_id;

        $this->cerrar_conexion();
        // Devuelve el ID recién insertado
        return $id_insertado;
    }

    // Para atributos que estan nulos en la bd
    /*
    public function insert_null($tabla, $columna, $atributo_tipo, $atributo_valor, $id_nombre, $id_valor)
    {
        //$atributo_tipo = "ii" El segundo siempre es i, pero el primero podría ser s
        $stmt = $this->obtener_conexion()->prepare("INSERT $tabla SET $columna=? WHERE $id_nombre=?");
        $stmt->bind_param($atributo_tipo, $atributo_valor, $id_valor);
        $stmt->execute();
        $this->cerrar_conexion();
    }*/


    public function update($tabla, $columna, $atributo_tipo, $atributo_valor, $id_nombre, $id_valor)
    {
        //$atributo_tipo = "ii" El segundo siempre es i, pero el primero podría ser s
        $stmt = $this->obtener_conexion()->prepare("UPDATE $tabla SET $columna=? WHERE $id_nombre=?");
        // Creamos un array de parámetros para llamar a bind_param
        $params = array(&$atributo_tipo, &$atributo_valor, &$id_valor);
        
        // Usamos call_user_func_array para llamar a bind_param con los parámetros dinámicamente
        call_user_func_array(array($stmt, 'bind_param'), $params);
        $stmt->execute();
        $stmt->close();
        $this->cerrar_conexion();
    }

    // SELECT para registro/s por medio de una vista
    public function select($vista, $atributo_tipo, $atributo_nombre, $atributo_valor, $registros = false)
    {
        // Utilizando las vistas se obtienen uno o muchos registros que coincidan con el atributo
        $stmt = $this->obtener_conexion()->prepare("SELECT * FROM $vista WHERE $atributo_nombre=?");
        $stmt->bind_param($atributo_tipo, $atributo_valor);
        $stmt->execute();
        $registro = $stmt->get_result();
        if ($registros) {
            // Para todos los registros que coincidan
            $registro = $registro->fetch_all(MYSQLI_ASSOC);
        } else {
            // Solo para un registro
            $registro = $registro->fetch_assoc();
        }
        ;
        $this->cerrar_conexion();
        // Devuelve el o los registros
        return $registro;
    }

    //SELECT simple para obtener el valor de un atributo según otro atributo
    // despues de usar este select es necesario cerrar la bd con el metodo cerrar_conexion
    public function select_simple($tabla, $atributo_nombre, $atributo_valor, $atributo_tipo, $atributo_nombre_obtener)
    {
        $resultado = $this->obtener_conexion()->prepare("SELECT $atributo_nombre_obtener FROM $tabla WHERE $atributo_nombre = ?");
        $resultado->bind_param($atributo_tipo, $atributo_valor);
        $resultado->execute();
        return $resultado;
    }

    public function cerrar_conexion() {
        $this->conexion->close();
    }
}
