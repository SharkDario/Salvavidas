<?php
require __DIR__ . '/../vendor/autoload.php';

use Endroid\QrCode\QrCode;

require_once 'Base_de_datos.php';
require_once 'Persona.php';
// Incluye la biblioteca PHP QR Code
//include './libs/qrlib.php';

//require '.../vendor/autoload.php'; // Asegúrate de que esta ruta sea correcta





header('Content-Type: application/json');
class Paciente extends Persona
{
    private $pac_id_paciente;
    private $pac_estatura;
    private $pac_peso;
    private $pac_qr;
    private $pac_fecha_alta;
    private $pac_fecha_baja;
    private $pac_descripcion_baja;

    // Constructor para un Paciente Nuevo
    public function __construct($datos_paciente)
    {
        // Se crea la Persona
        parent::__construct($datos_paciente);
        // Extrae los valores del arreglo asociativo
        $pac_estatura = $datos_paciente["pac_estatura"] ?? null;
        $pac_peso = $datos_paciente["pac_peso"] ?? null;
        $pac_fecha_alta = $datos_paciente["pac_fecha_alta"] ?? null;
        $registro_nuevo = $datos_paciente["registro_nuevo"] ?? false;

        // Se asignan los valores a los atributos
        $this->pac_estatura = $pac_estatura;
        $this->pac_peso = $pac_peso;
        $this->pac_fecha_alta = $pac_fecha_alta;
        
        if ($registro_nuevo) {
            $base_de_datos = new Base_de_datos();
            // Si es un registro nuevo se procede a preparar la consulta INSERT
            // Consultas Preparadas - Prepared Statements stmt 
            // MySQL espera el formato 'YYYY-MM-DD HH:MM:SS' en Datetime
            $per_id_persona = $this->get_id_persona();
            $nombre_columnas = array("pac_estatura", "pac_peso", "pac_fecha_alta", "per_id_persona");
            $atributos_valores = array($pac_estatura, $pac_peso, $pac_fecha_alta, $per_id_persona);
            $this->pac_id_paciente = $base_de_datos->insert("paciente", $nombre_columnas, "iisi", $atributos_valores);
            /*
            // Datos para el código QR
            $pac_id_paciente = $this->pac_id_paciente;

            // Crea el código QR
            $qrCode = new QrCode($pac_id_paciente);

            // Convierte el código QR a una cadena binaria (data URI)
            $qrBinary = $qrCode->writeDataUri();

            // Inserta el código QR en la base de datos
            $base_de_datos = new Base_de_datos();
            $base_de_datos->update("paciente", "pac_qr", "bi", $qrBinary, "pac_id_paciente", $pac_id_paciente);*/
        } else {
            // En el caso de un registro ya guardado anteriormente, en el diccionario ya se tiene el medper_id_medico
            $this->pac_id_paciente = $datos_paciente["pac_id_paciente"];
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

    public function get_fecha_alta()
    {
        return $this->pac_fecha_alta;
    }
    public function get_fecha_baja()
    {
        return $this->pac_fecha_baja;
    }
    public function get_descripcion_baja()
    {
        return $this->pac_descripcion_baja;
    }

    public function set_estatura($estatura)
    {
        $this->pac_estatura = $estatura;
        $base_de_datos = new Base_de_datos();
        $base_de_datos->update("paciente", "pac_estatura", "ii", $estatura, "pac_id_paciente", $this->pac_id_paciente);
    }
    public function set_peso($peso)
    {
        $this->pac_peso = $peso;
        $base_de_datos = new Base_de_datos();
        $base_de_datos->update("paciente", "pac_peso", "ii", $peso, "pac_id_paciente", $this->pac_id_paciente);
    }

    public function set_fecha_alta($alta)
    {
        $this->pac_fecha_alta = $alta;
        $base_de_datos = new Base_de_datos();
        $base_de_datos->update("paciente", "pac_fecha_alta", "si", $alta, "pac_id_paciente", $this->pac_id_paciente);
    }

    public function set_fecha_baja($baja)
    {
        $this->pac_fecha_baja = $baja;
        $base_de_datos = new Base_de_datos();
        $base_de_datos->update("paciente", "pac_fecha_baja", "si", $baja, "pac_id_paciente", $this->pac_id_paciente);
    }

    public function set_descripcion_baja($baja)
    {
        $this->pac_descripcion_baja = $baja;
        $base_de_datos = new Base_de_datos();
        $base_de_datos->update("paciente", "pac_descripcion_baja", "si", $baja, "pac_id_paciente", $this->pac_id_paciente);
    }
}

//$current_directory = getcwd();
//phpinfo();
/*
$arreglo_paciente = array(
    "per_nombre" => "Damian",
    "per_apellido" => "Zarza",
    "per_sexo" => "hombre",
    "per_dni" => 77775454,
    "per_fecha_nacimiento" => "1998-08-07",
    "per_tipo_sangre" => "A+",
    "pac_estatura" => 170,
    "pac_peso" => 80,
    "pac_fecha_alta" => "2024-05-27",
    "registro_nuevo" => true
);
$paciente = new Paciente($arreglo_paciente);
*/
// Directorio temporal para almacenar el código QR
            /*$dir = 'temp/';

            // Verifica si el directorio existe, si no, crea el directorio
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }

            // Nombre de archivo para el código QR
            $filename = $dir . 'codigo_qr.png';
            // Genera el código QR y guarda la imagen
            QRcode::png($pac_id_paciente, $filename);

            // Abre el archivo del código QR y conviértelo en datos binarios
            $qrBinary = file_get_contents($filename);

            $base_de_datos = new Base_de_datos();
            $base_de_datos->update("paciente", "pac_qr", "bi", $qrBinary, "pac_id_paciente", $pac_id_paciente);

            // Elimina el archivo del código QR después de guardarlo en la base de datos
            unlink($filename);*/