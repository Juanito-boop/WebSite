<?php

use Dotenv\Dotenv as Dotenv;

require_once '../../vendor/autoload.php';

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
    curl_setopt($ch, CURLOPT_URL, 'https://' . $_ENV['ID_PROJECT'] . '.supabase.co/auth/v1/token?grant_type=password');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'apikey: ' . $_ENV['APIKEY'],
        'Content-Type: application/json',
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);

    $response = curl_exec($ch);

    curl_close($ch);

    $data = json_decode($response, true);
    if (!empty($data)) {
        session_start();
        if (isset($data['access_token']) && isset($data['user']['role'])) {
            $rol = $data['user']['role'];
            $token = $data['access_token'];
            $_SESSION['admin'] = $rol;
            $_SESSION['token'] = $token;
            if ($rol === "Admin") {
                header("Location: ../../index.php?token=$token&isSuperAdmin=true");
            } else if ($rol === "authenticated") {
                header("Location: ../../index.php?token=$token&isSuperAdmin=false");
            }
        }
    } else {
        echo '<script>alert("Contraseña incorrecta / Usuario no encontrado."); window.location.href = "login.html";</script>';
    }
}