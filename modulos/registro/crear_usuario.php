<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //variables
    $email = $_POST['email'];
    $password = $_POST['clave'];
    $data = [
        'email' => $email,
        'password' => $password,
    ];
    $json_data = json_encode($data);

    //cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://npuxpuelimayqrsmzqur.supabase.co/auth/v1/signup');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'apikey: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6Im5wdXhwdWVsaW1heXFyc216cXVyIiwicm9sZSI6ImFub24iLCJpYXQiOjE2ODU5MzIyOTMsImV4cCI6MjAwMTUwODI5M30.XBKmo8wZRwFviHAgQjgDbbE3D_vmaeqvEP4mKi6W3bU',
        'Content-Type: application/json',
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);

    //Respuesta http
    if ($httpCode == 201) {
        echo '<script>alert("Registro exitoso.");window.location.href = "../inicio-sesion/login.html";</script>';
    } else {
        echo "<script>alert('Error al crear un usuario '$httpCode);
              if (confirm('¿Quieres volver al inicio de sesión?')) {
                  window.location.href = '../inicio-sesion/login.html';
              }</script>";
    }
} else {
    include 'registro.html';
}
