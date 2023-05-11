<?php
session_start();
include_once('../../db/DatabaseV2.php');

// Obtenemos la conexión a la base de datos
$db = DatabaseV2::getInstance();
$pdo = $db->getConnection();

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

    // Verificamos si el nombre de usuario ya está en uso en la base de datos
    $consulta_usuario = "SELECT COUNT(*) FROM usuarios WHERE usuario = ?";
    $statement = $pdo->prepare($consulta_usuario);
    $statement->execute([$usuario]);
    $existe_usuario = $statement->fetchColumn();
    if ($existe_usuario) {
        // Si el nombre de usuario ya está en uso, enviamos un mensaje de error al usuario
        die("El nombre de usuario ya está en uso");
    } else {
        // Si el nombre de usuario no está en uso, procedemos a crear el nuevo registro
        $crear = $pdo->prepare("INSERT INTO usuarios (usuario, clave, nombre, apellido, email, rol) VALUES (:usuario, :clave, :nombre, :apellido, :email, :rol)");
        $resultado = $crear->execute([
            'usuario' => $usuario,
            'clave' => $clave_hash,
            'nombre' => $nombre,
            'apellido' => $apellido,
            'email' => $email,
            'rol' => 'UsuarioCorriente'
        ]);
        if ($resultado) {
            // Si el registro se ha creado exitosamente, redireccionamos al usuario a la página de inicio de sesión
            header("Location: ../../modulos/inicio-sesion/login.html");
        } else {
            // Si la inserción falló por alguna razón, enviamos un mensaje de error al usuario
            die("Error al crear el usuario");
        }
    }
} else {
    // Si no se enviaron todos los datos requeridos, enviamos un mensaje de respuesta indicando que faltan datos
    die("Faltan datos");
}