<?php
// Iniciamos la sesión de PHP
session_start();
// Importamos el archivo con las constantes para conectarnos a la base de datos
include_once('../../config/Database.php');

$obj = new Database();
$conn = $obj->Conexion();

// Verificamos si se han enviado los datos a través de la solicitud POST
if (isset($_POST['usuario']) && isset($_POST['clave']) && isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['email'])) {
    // Asignamos las variables con los valores enviados a través de POST
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    //contrasena fuerte
    $clave_hash = password_hash($clave, PASSWORD_DEFAULT);
    // Preparamos la consulta SQL para insertar al usuario en la base de datos
    $crear = $conn->prepare("INSERT INTO usuarios (usuario, clave, nombre, apellido, email, rol) VALUES (:usuario, :clave, :nombre, :apellido, :email, :rol)");
    // Ejecutamos la consulta, vinculando los valores de los marcadores de posición con las variables PHP correspondientes
    $crear->execute(['usuario' => $usuario, 'clave' => $clave_hash, 'nombre' => $nombre, 'apellido' => $apellido, 'email' => $email, 'rol' => 'UsuarioCorriente']);
    // Enviamos un mensaje de respuesta al usuario indicando que el usuario ha sido creado exitosamente
    header("Location: ../../modulos/inicio-sesion/login.html");
} else {
    // Si no se enviaron todos los datos requeridos, enviamos un mensaje de respuesta indicando que faltan datos
    echo "Faltan datos";
}