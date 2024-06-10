<?php
require __DIR__ . '/../vendor/autoload.php';
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

// Incluir librerías necesarias
require_once 'Base_de_datos.php';
require_once 'Persona.php'; 

class Paciente extends Persona
{
    private $pac_id_paciente;
    private $pac_estatura;
    private $pac_peso;
    private $pac_qr;

    // Constructor para un Paciente Nuevo
    public function __construct($datos_paciente)
    {
        // Se crea la Persona
        parent::__construct($datos_paciente);
        // Extrae los valores del arreglo asociativo
        $pac_estatura = $datos_paciente["pac_estatura"] ?? null;
        $pac_peso = $datos_paciente["pac_peso"] ?? null;
        $usu_id_usuario = $datos_paciente["usu_id_usuario"] ?? null;
        $mov_fecha_alta = $datos_paciente["mov_fecha_alta"] ?? null;
        $mov_descripcion = $datos_paciente["mov_descripcion"] ?? null;
        $mov_fecha_movimiento = $datos_paciente["mov_fecha_movimiento"] ?? null;
        $registro_nuevo = $datos_paciente["registro_nuevo"] ?? false;

        // Se asignan los valores a los atributos
        $this->pac_estatura = $pac_estatura;
        $this->pac_peso = $pac_peso;

        if ($registro_nuevo) {
            $base_de_datos = new Base_de_datos();
            // Si es un registro nuevo se procede a preparar la consulta INSERT
            // Consultas Preparadas - Prepared Statements stmt 
            // MySQL espera el formato 'YYYY-MM-DD HH:MM:SS' en Datetime
            $per_id_persona = $this->get_id_persona();
            
            $this->pac_id_paciente = $base_de_datos->insert_paciente_trigger($usu_id_usuario, $mov_fecha_alta, $mov_descripcion, $mov_fecha_movimiento, $pac_estatura, $pac_peso, $per_id_persona);
            //($usu_id_usuario, $mov_fecha_alta, $mov_descripcion, $pac_estatura, $pac_peso, $per_id_persona)
            //https://salvavidas.great-site.net/salvavidas/views/g_ver_paciente/ver_paciente.php?id=1
            $enlace = "http://localhost/salvavidas/views/g_ver_paciente/ver_paciente.php?id=";
            //$enlace = "https://salvavidas.great-site.net/salvavidas/views/g_ver_paciente/ver_paciente.php?id=";
            $data = $enlace . strval($this->pac_id_paciente);

            // Configurar opciones para QRCode, si es necesario
            $options = new QROptions([
                'outputType' => QRCode::OUTPUT_MARKUP_SVG,
                'eccLevel' => QRCode::ECC_L, // Nivel de corrección de errores, puede ser L, M, Q, H
                'scale' => 5, // Escala del QR, ajusta según sea necesario
            ]);

            // Generar el código QR en formato 
            $qr = new QRCode($options);

            // Obtener la imagen del código QR en formato 
            $qrImageData = $qr->render($data);

            // Se guarda en la base de datos
            $base_de_datos = new Base_de_datos();
            $base_de_datos->update("paciente", "pac_qr", "si", $qrImageData, "pac_id_paciente", $this->pac_id_paciente);
            
        } else {
            // En el caso de un registro ya guardado anteriormente, en el diccionario ya se tiene el medper_id_medico
            $this->pac_id_paciente = $datos_paciente["pac_id_paciente"];
            $this->pac_qr = $datos_paciente["pac_qr"]; 
        }
    }

    public function get_id_paciente()
    {
        return $this->pac_id_paciente;
    }

    public function get_estatura()
    {
        return $this->pac_estatura;
    }
    public function get_peso()
    {
        return $this->pac_peso;
    }

    public function get_qr()
    {
        return $this->pac_qr;
    }

    public function set_estatura($estatura)
    {
        $this->pac_estatura = $estatura;
        $base_de_datos = new Base_de_datos();
        $base_de_datos->update("paciente", "pac_estatura", "di", $estatura, "pac_id_paciente", $this->pac_id_paciente);
    }
    public function set_peso($peso)
    {
        $this->pac_peso = $peso;
        $base_de_datos = new Base_de_datos();
        $base_de_datos->update("paciente", "pac_peso", "di", $peso, "pac_id_paciente", $this->pac_id_paciente);
    }
}

/*
$registro = array(
    "per_nombre" => "Damian",
    "per_apellido" => "Zarza",
    "per_sexo" => "hombre",
    "per_dni" => 77775454,
    "per_fecha_nacimiento" => "1998-08-07",
    "per_tipo_sangre" => "A+",
    "pac_estatura" => 170,
    "pac_peso" => 80,
    "usu_id_usuario" => 1,
    "mov_fecha_alta" => "2024-01-06 15:00:00",
    "mov_descripcion" => "Descripción",
    "registro_nuevo" => true

);
$base_de_datos = new Base_de_datos();

$paciente = new Paciente($registro);*/

/*
for ($i=1; $i<=12; $i++) {
    $enlace = "http://localhost/salvavidas/views/g_ver_paciente/ver_paciente.php?id=";
    $data = $enlace . strval($i);

    // Configurar opciones para QRCode, si es necesario
    $options = new QROptions([
        'outputType' => QRCode::OUTPUT_MARKUP_SVG,
        'eccLevel' => QRCode::ECC_L, // Nivel de corrección de errores, puede ser L, M, Q, H
        'scale' => 5, // Escala del QR, ajusta según sea necesario
    ]);

    // Generar el código QR en formato 
    $qr = new QRCode($options);

    // Obtener la imagen del código QR en formato 
    $qrImageData = $qr->render($data);

    // Se guarda en la base de datos
    $base_de_datos = new Base_de_datos();
    $base_de_datos->update("paciente", "pac_qr", "si", $qrImageData, "pac_id_paciente", $i);
}
*/