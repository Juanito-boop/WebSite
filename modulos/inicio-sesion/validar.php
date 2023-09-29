<?php

use cURL\auth;

require_once __DIR__ . '/../../cURL/auth.php';

$auth = auth::getInstance();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    try {
        $email = $_POST['email'];
        $password = $_POST['pass'];

        $data = $auth->USER_LOGIN_MAIL_PASS($email, $password);

        if (!empty($data)) {
            session_start();

            if (isset($data['access_token']) && isset($data['user']['role'])) {
                $rol = $data['user']['role'];
                $token = $data['access_token'];
                $_SESSION['admin'] = $rol; // Guardar el rol en la sesión
                $_SESSION['token'] = $token; // Guardar el token en la sesión
                header("Location: ../../index.php");
            }
        } else {
            echo '<script>alert("Contraseña incorrecta / Usuario no encontrado."); window.location.href = "login.html";</script>';
        }
    } catch (Exception $e) {
        // Manejo de excepciones en caso de error
        echo "Error: " . $e->getMessage();
    }
}