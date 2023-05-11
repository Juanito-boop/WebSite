<?php
// Singleton
// Incluir el archivo de configuración para obtener los valores de conexión
include_once('./config/dataBD.php');

// Declarar la clase Database
class Database
{
    function ConexionSERVIDOR()
    {
        try {
            $dsn = "pgsql:host=" . HOST . ";port=" . PORT . ";dbname=" . DBNAME;
            $pdo = new PDO($dsn, USER, PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            error_log("Error de conexión a la base de datos: " . $e->getMessage());
            return null;
        }
    }
    function ConexionLOCAL()
    {
        try {
            $dsn = "pgsql:host=" . SERVER . ";port=" . PORT . ";dbname=" . DBNAME_LOCAL;
            $pdo = new PDO($dsn, USER_LOCAL, PASSWORD_LOCAL);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            error_log("Error de conexión a la base de datos: " . $e->getMessage());
            return null;
        }
    }


}