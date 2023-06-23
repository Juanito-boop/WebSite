<?php

use Supabase\Storage\StorageClient;
use Dotenv\Dotenv as Dotenv;

include '../../vendor/autoload.php';
$dotenv = Dotenv::createUnsafeImmutable('../../');
$dotenv->load();

$path = $_FILES['imagenes']['tmp_name'];
$file = $_FILES['imagenes']['name'];
$options = [
    'cacheControl' => 'public, max-age=31536000',
    'upsert' => false,
    'contentType' => null,
    'contentEncoding' => null,
    'contentDisposition' => null,
    'metadata' => null,
];
$rpath = realpath($path);

$client = new StorageClient($_ENV['APIKEY'], $_ENV['ID_PROJECT']);
$result = $client->upload($rpath, $file, $options);

if ($result['error']) {
    echo $result['error'];
} else {
    echo $result['signedURL'];
}

?>