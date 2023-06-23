<?php

require_once '../../vendor/autoload.php';

use Dotenv\Dotenv as Dotenv;

$dotenv = Dotenv::createUnsafeImmutable('../../');
$dotenv->load();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = $_POST['email'];
    $password = $_POST['pass'];
    $data = [
        'email' => $email,
        'password' => $password,
    ];
    $json_data = json_encode($data);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://npuxpuelimayqrsmzqur.supabase.co/auth/v1/token?grant_type=password');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'apikey: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6Im5wdXhwdWVsaW1heXFyc216cXVyIiwicm9sZSI6ImFub24iLCJpYXQiOjE2ODU5MzIyOTMsImV4cCI6MjAwMTUwODI5M30.XBKmo8wZRwFviHAgQjgDbbE3D_vmaeqvEP4mKi6W3bU',
        'Content-Type: application/json',
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);

    $response = curl_exec($ch);

    curl_close($ch);

    $data = json_decode($response, true);
    if (!empty($data)) {
        session_start();
        $token = $data['access_token'];
        $_SESSION['token'] = $token;
        $admin = $data['is_super_admin'];
        $_SESSION['admin'] = $admin;
        if ($admin != null) {
            header("Location: ../../index.php?token=$token&isSuperAdmin=true");
        } else {
            header("Location: ../../index.php?token=$token&isSuperAdmin=false");
        }
    } else {
        echo '<script>alert("Contraseña incorrecta / Usuario no encontrado."); window.location.href = "login.html";</script>';
    }
}