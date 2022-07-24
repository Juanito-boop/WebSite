<?php
    class Database{
        private $host = "db.hijaeegxjbuivzckpijg.supabase.co";
        private $db_name = "postgres";
        private $port = "5432";
        private $username = "postgres";
        private $password = ")QZzqAiwP*3(EA4Q";
        private $charset = "utf8";

        function conectar(){
            try{
                // $conexion = "mysql:host=".$this->host.";dbname=".$this->db_name.";charset=".$this->charset;
                $conexion = "supabase:host=".$this->username.";password=".$this->password.";host=".$this->host.";port=".$this->port.";dbname=".$this->db_name;
                // user=postgres password=[YOUR-PASSWORD] host=db.hijaeegxjbuivzckpijg.supabase.co port=5432 dbname=postgres
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