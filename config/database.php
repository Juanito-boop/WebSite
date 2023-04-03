<?php
include_once('dataBD.php');
class Connection
{
    //Este bloque de código es un método Conexion() que intenta conectarse a una base de datos PostgreSQL utilizando la clase PDO. 
    function Conexion()
    {
        //Primero, se define la cadena de conexión en la variable $dsn concatenando los valores de las constantes HOST, PORT, y DBNAME definidos en algún archivo de configuración, y se utiliza la función new PDO() para crear una instancia de la clase PDO con los parámetros necesarios para la conexión: la cadena de conexión $dsn, el nombre de usuario $USER y la contraseña $PASSWORD. A continuación, se establece el modo de error para PDO como ERRMODE_EXCEPTION, lo que significa que PDO lanzará una excepción en caso de que se produzca un error en la conexión o en cualquier consulta posterior. Finalmente, si todo funciona bien, el método devuelve la instancia de PDO, lo que significa que la conexión se ha establecido correctamente. Si ocurre un error durante la conexión, se captura la excepción PDOException y se registra un mensaje de error en el archivo de registro de errores mediante la función error_log(). En este caso, el método devuelve null.
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