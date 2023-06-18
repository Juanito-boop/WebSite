<?php

// URL de la API de roles de Supabase
$roles_url = 'https://npuxpuelimayqrsmzqur.supabase.co/auth/v1/roles';

// Datos del nuevo rol personalizado
$name = $_POST['nombreRol'];
$leerPermiso = $_POST['permisos_leer'] ?? "false";
$agregarPermiso = $_POST['permisos_agregar'] ?? "false";
$actualizarPermiso = $_POST['permisos_actualizar'] ?? "false";
$eliminarPermiso = $_POST['permisos_eliminar'] ?? "false";

$permissions = array(
    'schemas' => array(
        'public' => array(
            'tables' => array(
                '*' => array(
                    'select' => $leerPermiso,
                    'insert' => $agregarPermiso,
                    'update' => $actualizarPermiso,
                    'delete' => $eliminarPermiso
                )
            )
        )
    )
);

// Configurar la solicitud HTTP POST
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $roles_url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array(
    'name' => $name,
    'permissions' => $permissions
)));
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'apikey: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6Im5wdXhwdWVsaW1heXFyc216cXVyIiwicm9sZSI6ImFub24iLCJpYXQiOjE2ODU5MzIyOTMsImV4cCI6MjAwMTUwODI5M30.XBKmo8wZRwFviHAgQjgDbbE3D_vmaeqvEP4mKi6W3bU',
    'Content-Type: application/json'
));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Ejecutar la solicitud HTTP POST
$result = curl_exec($ch);

// Comprobar si la solicitud fue exitosa
if ($result === false) {
    echo 'Error al crear el rol personalizado: ' . curl_error($ch);
} else {
    $response = json_decode($result, true);
    if (isset($response['error'])) {
        echo 'Error al crear el rol personalizado: ' . $response['error_description'];
    } else {
        echo 'Rol personalizado creado exitosamente.';
        echo '<br><br>';
        echo 'Roles agregados:';
        echo '<ul>';
        echo '<li>Nombre de Rol: ' . $response['name'] . '</li>';
        echo '<li>Leer: ' . $leerPermiso . '</li>';
        echo '<li>Agregar: ' . $agregarPermiso . '</li>';
        echo '<li>Actualizar: ' . $actualizarPermiso . '</li>';
        echo '<li>Eliminar: ' . $eliminarPermiso . '</li>';
        echo '</ul>';
    }
}

// Cerrar la conexión cURL
curl_close($ch);
