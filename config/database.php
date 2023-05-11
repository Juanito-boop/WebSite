<?php
include_once('dataBD.php');
class Database
{
    //Este bloque es un método Conexion() que intenta conectarse a una base de datos PostgreSQL utilizando PDO. 
    function Conexion()
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
}