<?php
//Este código define variables que contienen información necesaria para establecer una conexión a una base de datos PostgreSQL. La variable $host contiene la dirección IP del servidor donde está alojada la base de datos (127.0.0.1 se refiere a la dirección IP local del servidor). La variable $db_name contiene el nombre de la base de datos que se utiliza. La variable $port contiene el número del puerto a través del cual se realiza la conexión. La variable $username contiene el nombre de usuario con los privilegios necesarios para acceder a la base de datos. La variable $password contiene la contraseña asociada al usuario especificado. La variable $charset define el conjunto de caracteres utilizado para codificar la información almacenada en la base de datos. Estas variables serán utilizadas en una conexión a la base de datos PostgreSQL y permitirán establecer una comunicación con éxito.
$host = "127.0.0.1";
$db_name = "postgres";
$port = "5432";
$username = "postgres";
$password = "postgresql";
$charset = "utf8";

try {
    $conn = "pgsql:host=" . $host . ";port=" . $port . ";dbname=" . $dbname;
    $pdo = new PDO($conn, $username, $password, [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION]);

    if ($pdo) {
        echo "Conexión exitosa";
        $stmt = $pdo->query("SELECT * FROM usuarios;");

        while ($row = $stmt->fetch()) {
            echo "<br> ID: $row[0]<br> Username: $row[1]<br> Password: $row[2]";
        }
    }
} catch (PDOException $e) {
    die($e->getMessage());
}

$conn = null;
?>