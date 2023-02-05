<?php
/* The connection string to the database. */
// $host = "db.hijaeegxjbuivzckpijg.supabase.co";
// $db_name = "postgres";
// $port = "5432";
// $username = "postgres";
// $pasword = ")QZzqAiwP*3(EA4Q";
// $charset = "utf8";
$host = "127.0.0.1";
$db_name = "postgres";
$port = "5432";
$username = "postgres";
$password = "postgresql";
$charset = "utf8";
/* Trying to connect to the database and if it fails it will show an error message. */
try {
    $base_de_datos = new PDO("pgsql:host=$host;dbname=$db_name", $username, $password);
    // Establecer el modo de error para PDO como EXCEPTION
    $base_de_datos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Conexión exitosa a la base de datos";
} catch (PDOException $e) {
    echo "Error de conexión a la base de datos: " . $e->getMessage();
}
