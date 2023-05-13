<?php
// namespace db;

// Incluir el archivo de configuración para obtener los valores de conexión
require_once('./config/dataBD.php');

// Declarar la clase DatabaseV2
class DatabaseV2
{
    // Una única instancia de la clase
    private static $instance = null;
    private $connection;

    // Constructor privado para evitar instancias directas
    private function __construct()
    {
        try {
            // Datos de conexión a la base de datos
            $dsn = 'pgsql:host=' . SERVER . ';dbname=' . DBNAME_LOCAL . ';port=' . PORT . ';options=\'--client_encoding=' . CHARSET . '\'';
            $user = USER_LOCAL;
            $password = PASSWORD_LOCAL;
            $options = array(
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
            );
            // Creamos la conexión PDO y la almacenamos en la propiedad $connection
            $this->connection = new \PDO($dsn, $user, $password, $options);
        } catch (\PDOException $e) {
            echo 'Error de conexión: ' . $e->getMessage();
            exit;
        }
    }

    // Método estático para obtener la única instancia de la clase
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // Método para obtener la conexión PDO
    public function getConnection()
    {
        return $this->connection;
    }
}