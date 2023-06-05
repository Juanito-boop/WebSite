<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ch = curl_init();

    $username = $_POST['user'];
    $password = $_POST['pass'];

    $url = "https://npuxpuelimayqrsmzqur.supabase.co/rest/v1/usuarios?usuario=eq.$username";
    $apiKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6Im5wdXhwdWVsaW1heXFyc216cXVyIiwicm9sZSI6ImFub24iLCJpYXQiOjE2ODU5MzIyOTMsImV4cCI6MjAwMTUwODI5M30.XBKmo8wZRwFviHAgQjgDbbE3D_vmaeqvEP4mKi6W3bU';
    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => [
            "Authorization: Bearer $apiKey",
            "apikey: $apiKey",
        ],
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);
    if (!empty($data)) {
        $hashedPassword = $data[0]['clave'];

        if (password_verify($password, $hashedPassword)) {
            if ($data[0]['rol'] == 'Administrador') {
                header('Location: ../carga-producto-bd/formulario-nuevo-producto.php');
            } else {
                header('Location: ../../index.php');
            }
        } else {
            echo 'Nombre de usuario o contraseña incorrectos.';
        }
    } else {
        echo 'Nombre de usuario o contraseña incorrectos.';
    }
}
