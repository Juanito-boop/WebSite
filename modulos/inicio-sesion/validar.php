<?php
// Iniciamos la sesión de PHP
session_start();
// Importamos el archivo con las constantes para conectarnos a la base de datos
require('../../config/database.php');
// Verificamos si se han enviado las variables 'user' y 'pass' a través de la solicitud POST
if (isset($_POST['user']) && isset($_POST['pass'])) {
    // Asignamos las variables $usuario y $clave con los valores enviados a través de POST
    $usuario = $_POST['user'];
    $clave = $_POST['pass'];
    // Conectamos a la base de datos utilizando PDO
    $conexion = new PDO("pgsql:host=" . HOST . ";port=" . PORT . ";dbname=" . DBNAME, USER, PASSWORD);
    // Preparamos la consulta SQL para buscar al usuario en la base de datos
    $consulta = "SELECT usuario, clave FROM tienda.usuarios WHERE usuario=:usuario AND clave=:clave";
    // Creamos un objeto PDOStatement con la consulta SQL
    $statement = $conexion->prepare($consulta);
    // Ejecutamos la consulta, vinculando los valores de los marcadores de posición con las variables PHP correspondientes
    $statement->execute(['usuario' => $usuario, 'clave' => $clave]);
    // Obtenemos el resultado de la consulta
    $resultado = $statement->fetch();
    // Verificamos si se ha encontrado al usuario en la base de datos
    if ($resultado) {
        // Si se encontró al usuario, establecemos la variable de sesión 'usuario' con el valor de $usuario
        $_SESSION['usuario'] = $usuario;
        // Enviamos un mensaje de respuesta al usuario indicando que el inicio de sesión fue exitoso
        //echo "Inicio de sesion correcto";
        // Redireccionamos al usuario a la página de inicio (opcional)
        header('Location: /../../../index.php');
    } else {
        // Si no se encontró al usuario, enviamos un mensaje de respuesta indicando que el nombre de usuario o la contraseña son incorrectos
        echo "Usuario o contraseña incorrectos";
    }
} else {
    // Si no se enviaron las variables 'user' y 'pass', enviamos un mensaje de respuesta indicando que faltan datos
    echo "Faltan datos";
}