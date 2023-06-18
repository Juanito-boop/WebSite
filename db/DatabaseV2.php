<?php
require_once('./config/dataBD.php');
class DatabaseV2
{
    private static ?DatabaseV2 $instance = null;
    private PDO $connection;
    private function __construct()
    {
        try {
            $dsn = 'pgsql:host=' . HOST .
                ';dbname=' . DBNAME .
                ';port=' . PORT .
                ';options=\'--client_encoding=' . CHARSET . '\'';
            $user = USER;
            $password = PASSWORD;
            $options = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            );

            $this->connection = new PDO($dsn, $user, $password, $options);
        } catch (PDOException $e) {
            echo 'Error de conexión: ' . $e->getMessage();
            exit;
        }
    }

    public static function getInstance(): ?DatabaseV2
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}