<?php

use Dotenv\Dotenv;

require __DIR__ . '/../../vendor/autoload.php';

$dotenv = Dotenv::createUnsafeImmutable(__DIR__ . '/../../');
$dotenv->load();

$bucket = 'my-bucket';
$file = file_get_contents($_FILES['imagenes']['tmp_name']);
$filename = $_FILES['imagenes']['name'];
$projectId = $_ENV['ID_PROJECT'];

$url = 'https://storage.supabase.io/storage/v1/object/' . $bucket . '/' . $filename . '?projectId=' . $projectId;

$ch = curl_init();
curl_setopt($ch, option: CURLOPT_URL, value: $url);
curl_setopt($ch, option: CURLOPT_RETURNTRANSFER, value: true);
curl_setopt($ch, option: CURLOPT_CUSTOMREQUEST, value: 'POST');
curl_setopt($ch, option: CURLOPT_POSTFIELDS, value: $file);
curl_setopt($ch, option: CURLOPT_HTTPHEADER, value: array(
    'Content-Type: application/octet-stream',
    'Authorization: Bearer ' . $_ENV['APIKEY']
));

$response = curl_exec($ch);
curl_close($ch);

// Decodificar la respuesta JSON
$data = json_decode($response, true);

// Obtener la URL del archivo recién subido
$url = $data['url'];
echo $url;