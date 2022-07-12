<?php
class Database{
    private $host = "localhost";
    private $db_name = "tienda_online";
    private $username = "tienda";
    private $password = ")QZzqAiwP*3(EA4Q";
    private $charset = "utf8";

    function conectar(){
        try{
            $conexion = "mysql:host=".$this->host.";dbname=".$this->db_name.";charset=".$this->charset;
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            $pdo = new PDO($conexion, $this->username, $this->password, $options);
            return $pdo;
        }catch(PDOException $e){
            echo("Error connection: ".$e->getMessage());
            exit;
        }
    }
}
?>