<?php
// Iniciamos la sesión de PHP
session_start();
// Importamos el archivo con las constantes para conectarnos a la base de datos
require('../../config/database.php');
// Verificamos si se han enviado los datos a través de la solicitud POST
if (isset($_POST['usuario']) && isset($_POST['clave']) && isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['email'])) {
    // Asignamos las variables con los valores enviados a través de POST
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    // Conectamos a la base de datos utilizando PDO
    $conexion = new PDO("pgsql:host=" . HOST . ";port=" . PORT . ";dbname=" . DBNAME, USER, PASSWORD);
    // Preparamos la consulta SQL para insertar al usuario en la base de datos
    $consulta = "INSERT INTO tienda.usuarios (usuario, clave, nombre, apellido, email, rol) VALUES (:usuario, :clave, :nombre, :apellido, :email, :rol)";
    // Creamos un objeto PDOStatement con la consulta SQL
    $statement = $conexion->prepare($consulta);
    // Ejecutamos la consulta, vinculando los valores de los marcadores de posición con las variables PHP correspondientes
    $statement->execute(['usuario' => $usuario, 'clave' => $clave, 'nombre' => $nombre, 'apellido' => $apellido, 'email' => $email, 'rol' => 'UsuarioCorriente']);
    // Enviamos un mensaje de respuesta al usuario indicando que el usuario ha sido creado exitosamente
    echo "El usuario ha sido creado exitosamente";
} else {
    // Si no se enviaron todos los datos requeridos, enviamos un mensaje de respuesta indicando que faltan datos
    echo "Faltan datos";
}