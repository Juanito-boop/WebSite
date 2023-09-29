<?php

use cURL\auth;

require_once __DIR__ . '/../../cURL/auth.php';

$auth = auth::getInstance();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    try {
        $email = $_POST['email'];

        $data = $auth->USER_LOGIN_MAGIC_LINK(email: $email);
    }catch (Exception $e){
        echo "Error: " . $e->getMessage();
    }
}else{

}