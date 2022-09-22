<?php
    /* The connection string to the database. */
    $host = "db.hijaeegxjbuivzckpijg.supabase.co";
    $db_name = "postgres";
    $port = "5432";
    $username = "postgres";
    $pasword = ")QZzqAiwP*3(EA4Q";
    $charset = "utf8";
    /* Trying to connect to the database and if it fails it will show an error message. */
    try{
        $base_de_datos = new PDO("pgsql:host=$host; port=$port; dbname=$db_name", $username, $pasword);
        echo "conectado";
        $base_de_datos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $exp){
        echo "Error: " . $exp->getMessage();
        exit;
    }
?>