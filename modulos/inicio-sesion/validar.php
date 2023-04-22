<?php
// Iniciamos la sesión de PHP
session_start();
// Importamos el archivo con las constantes para conectarnos a la base de datos
require('../../config/database.php');
// Conectamos a la base de datos utilizando PDO
$conexion = new PDO("pgsql:host=" . HOST . ";port=" . PORT . ";dbname=" . DBNAME, USER, PASSWORD);
// Verificamos si se han enviado las variables 'user' y 'pass' a través de la solicitud POST
if (isset($_POST['user']) && isset($_POST['pass'])) {
    // Asignamos las variables $usuario y $clave con los valores enviados a través de POST
    $usuario = $_POST['user'];
    $clave = $_POST['pass'];
    // Preparamos la consulta SQL para buscar al usuario en la base de datos
    $consulta_usuario = "SELECT clave FROM usuarios WHERE usuario = ?";
    $statement = $conexion->prepare($consulta_usuario);
    $statement->execute([$usuario]);
    // Verificamos si se encontró al usuario en la base de datos
    if ($statement && $statement->rowCount() > 0) {
        // Si se encontró al usuario, recuperamos la versión encriptada de la clave almacenada en la base de datos
        $fila = $statement->fetch();
        $clave_encriptada = $fila['clave'];
        // Verificamos si la clave proporcionada coincide con la versión encriptada almacenada en la base de datos
        if (password_verify($clave, $clave_encriptada)) {
            // Si la clave proporcionada es correcta, redireccionamos al usuario a la página principal
            header("Location: ../../index.php");
        } else {
            // Si la clave proporcionada es incorrecta, redireccionamos al usuario de vuelta a la página de inicio de sesión
            header("Location: login.html");
        }
    } else {
        // Si no se encontró al usuario en la base de datos, redireccionamos al usuario de vuelta a la página de inicio de sesión
        header("Location: login.html");
    }
} else {
    // Si no se enviaron las variables 'user' y 'pass', enviamos un mensaje de respuesta indicando que faltan datos
    echo "Faltan datos";
}