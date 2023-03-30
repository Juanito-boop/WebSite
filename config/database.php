<?php
//Este código define variables que contienen información necesaria para establecer una conexión a una base de datos PostgreSQL. La variable $host contiene la dirección IP del servidor donde está alojada la base de datos (127.0.0.1 se refiere a la dirección IP local del servidor). La variable $db_name contiene el nombre de la base de datos que se utiliza. La variable $port contiene el número del puerto a través del cual se realiza la conexión. La variable $username contiene el nombre de usuario con los privilegios necesarios para acceder a la base de datos. La variable $password contiene la contraseña asociada al usuario especificado. La variable $charset define el conjunto de caracteres utilizado para codificar la información almacenada en la base de datos. Estas variables serán utilizadas en una conexión a la base de datos PostgreSQL y permitirán establecer una comunicación con éxito.
$host = "127.0.0.1";
$db_name = "postgres";
$port = "5432";
$username = "postgres";
$password = "postgresql";
$charset = "utf8";

//Este código PHP establece una conexión a una base de datos PostgreSQL utilizando la clase PDO. Se especifica el host, el nombre de la base de datos, el nombre de usuario y la contraseña como argumentos para inicializar un objeto PDO. Luego, se establece el modo de error para PDO en EXCEPTION. En caso de que haya algún error al conectarse a la base de datos, se captura la excepción mediante un bloque try-catch. Si se produce una excepción, se obtiene el mensaje de error y se muestra en la pantalla utilizando echo.
try {
    $_base_de_datos = new PDO("pgsql:host=$host;dbname=$db_name", $username, $password);
    // Establecer el modo de error para PDO como EXCEPTION
    $_base_de_datos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Conexión exitosa a la base de datos";
} catch (PDOException $e) {
    echo "Error de conexión a la base de datos: " . $e->getMessage();
}