<?php
include_once('dataBD.php');
class DatabaseLocal
{
    //Este bloque es un método Conexion() que intenta conectarse a una base de datos PostgreSQL utilizando PDO. 
    function Conexion()
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