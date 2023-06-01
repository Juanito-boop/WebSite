<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $curl = curl_init();

    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $email = $_POST["email"];
    $username = $_POST["usuario"];
    $password = $_POST["clave"];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $data = array(
        'usuario' => $username,
        'clave' => $hashedPassword,
        'nombre' => $nombre,
        'apellido' => $apellido,
        'email' => $email,
        'rol' => 'UsuarioCorriente'
    );

    $json_data = json_encode($data);

    $url = 'https://hijaeegxjbuivzckpijg.supabase.co/rest/v1/usuarios';
    $apiKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImhpamFlZWd4amJ1aXZ6Y2twaWpnIiwicm9sZSI6ImFub24iLCJpYXQiOjE2NTg1MTgxNjAsImV4cCI6MTk3NDA5NDE2MH0.dZo4cMQV2Xm1rugxdthp9Q8c40oHRkRHbrJlh4a3-BU';

    curl_setopt_array(
        $curl,
        options: array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $json_data,
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer $apiKey",
                "Content-Type: application/json",
                "Prefer: return=minimal",
                "apikey: $apiKey"
            ),
        )
    );

    $response = curl_exec($curl);
    $httpCode = curl_getinfo($curl, option: CURLINFO_HTTP_CODE);
    curl_close($curl);

    if ($httpCode == 200 || $httpCode == 201) {
        echo '<script>alert("Registro exitoso.");window.location.href = "../inicio-sesion/login.html";</script>';
    } else {
        echo "<script>alert('Error al crear un usuario '$httpCode); 
              if (confirm('¿Quieres volver al inicio de sesión?')) { 
                  window.location.href = '../inicio-sesion/login.html'; 
              }</script>";
    }
} else {
    include "registro.html";
}