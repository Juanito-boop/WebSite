<?php
// Singleton
// Incluir el archivo de configuración para obtener los valores de conexión
include_once('dataBD.php');

// Declarar la clase Database
class DatabaseV1
{
    // Propiedad estática para almacenar la única instancia de la clase
    private static $instance = null;

    // Propiedad para almacenar la conexión PDO
    private $pdo;

    // El constructor es privado para evitar que se cree una instancia directamente
    private function __construct()
    {
        try {
            $dsn = "pgsql:host=" . HOST . ";port=" . PORT . ";dbname=" . DBNAME;
            $this->pdo = new PDO($dsn, USER, PASSWORD);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            error_log("Error de conexión a la base de datos: " . $e->getMessage());
        }
    }

    // Método estático para obtener la única instancia de la clase
    public static function getInstance()
    {
        // Si la instancia no existe, crearla
        if (!self::$instance) {
            self::$instance = new DatabaseV1();
        } // Devolver la instancia
        return self::$instance;
    }

    // Método para obtener la conexión PDO
    public function getConnection()
    {
        return $this->pdo;
    }
}