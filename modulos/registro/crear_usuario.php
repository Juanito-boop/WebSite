<?php

use cURL\auth;

require_once  __DIR__ . '/../../cURL/auth.php';

$auth = auth::getInstance();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    try {
        // Variables
        $email = $_POST['email'];
        $password = $_POST['clave'];

        // Llamada a la función USER_SIGNUP
        $codigo = $auth->USER_SIGNUP(email: $email, password: $password);

        // Respuesta HTTP
        if ($codigo == 201) {
            echo '<script>alert("Registro exitoso.");window.location.href = "../inicio-sesion/login.html";</script>';
        } else {
            echo "<script>alert('Error al crear un usuario ');
              if (confirm('¿Quieres volver al inicio de sesión?')) {
                  window.location.href = '../inicio-sesion/login.html';
              }</script>";
        }
    } catch (Exception $e) {
        // Manejo de excepciones en caso de error
        echo "Error: " . $e->getMessage();
    }

} else {
    include 'registro.html';
}
