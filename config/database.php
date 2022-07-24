<?php
    // class Database{
    //     public static function conectar(){
    //         $host = "db.hijaeegxjbuivzckpijg.supabase.co";
    //         $db_name = "postgres";
    //         $port = "5432";
    //         $username = "postgres";
    //         $pasword = ")QZzqAiwP*3(EA4Q";
    //         $charset = "utf8";
    //         try{
    //             $conect = new PDO("pgsql:host=$host; port=$port; dbname=$db_name", $username, $pasword);
    //             echo "conectado";
                
    //         }catch(PDOException $exp){
    //             echo "Error: " . $exp->getMessage();
    //             exit;
    //         }
    //     }
    // }
    $host = "db.hijaeegxjbuivzckpijg.supabase.co";
    $db_name = "postgres";
    $port = "5432";
    $username = "postgres";
    $pasword = ")QZzqAiwP*3(EA4Q";
    $charset = "utf8";
    try{
        $base_de_datos = new PDO("pgsql:host=$host; port=$port; dbname=$db_name", $username, $pasword);
        echo "conectado";
        $base_de_datos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $exp){
        echo "Error: " . $exp->getMessage();
        exit;
    }
?>