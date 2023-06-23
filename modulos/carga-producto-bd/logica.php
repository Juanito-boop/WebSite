<?php
require_once '../../vendor/autoload.php';

use Dotenv\Dotenv as Dotenv;

$dotenv = Dotenv::createUnsafeImmutable('../../');
$dotenv->load();

$jwt = $_GET['token'];

// Inicializar el recurso cURL
$ch = curl_init();

// Configurar la URL del bucket de Supabase
$bucketUrl = 'https://' . $_ENV['ID_PROJECT'] . '.supabase.co/storage/v1/object/public/images/';
echo $bucketUrl;

// Configurar la URL de la imagen
$nombreArchivo = $_FILES['imagenes']['name'];
$urlImg = $bucketUrl . $nombreArchivo;

// Tipo de imagen
$imageType = $_FILES['imagenes']['type'];

// Configurar las opciones de cURL
curl_setopt($ch, CURLOPT_URL, $urlImg);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $jwt,
    'Content-Type: ' . $imageType,
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, [
    'file' => new CURLFile($_FILES['imagenes']['tmp_name']),
]);

// Ejecutar la solicitud cURL
$response = curl_exec($ch);

// Verificar si la solicitud fue exitosa
if ($response !== false) {
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($httpCode === 201 || $httpCode === 200) {
        $nombreVino = $_POST['nombre_vino'];
        $variedad = (int) $_POST['variedad'];
        $anno = (int) $_POST['annada'];
        $bodega = $_POST['bodega_vino'];
        $pais = (int) $_POST['pais'];
        $region = $_POST['region'];
        $precio = (int) $_POST['precio'];
        $stock = (int) $_POST['stock'];
        $tipos = $_POST['tipos'];
        $nivelAlcohol = $_POST['nivel_alcohol'];
        $tipoBarrica = $_POST['tipo_barrica'];
        $descripcion = $_POST['descripcion'];
        $notasCata = $_POST['notas_cata'];
        $temperaturaConsumo = $_POST['temperatura_consumo'];
        $maridaje = $_POST['maridaje'];
        $idCategoria = (int) $_POST['id_categoria'];
        $activo = isset($_POST['activo']) ? true : false;
        $uniqueId = crc32(uniqid());
        $url = $urlImg;
        $promocion = isset($_POST['promocion']) ? true : false;
        $busqueda = 4;

        $datosVino = [
            'nombre' => $nombreVino,
            'variedad' => $variedad,
            'anada' => $anno,
            'bodega' => $bodega,
            'pais' => $pais,
            'region' => $region,
            'precio' => $precio,
            'stock' => $stock,
            'tipo' => $tipos,
            'nivel_alcohol' => $nivelAlcohol,
            'tipo_barrica' => $tipoBarrica,
            'descripcion' => $descripcion,
            'notas_cata' => $notasCata,
            'temperatura_consumo' => $temperaturaConsumo,
            'maridaje' => $maridaje,
            'id_categoria' => $idCategoria,
            'activo' => $activo,
            'id_unica' => $uniqueId,
            'url_imagen' => $url,
            'promocion' => $promocion,
            'busqueda' => $busqueda,
        ];
        var_dump($datosVino);
    } else {
        echo 'Error al subir la imagen. Código de respuesta HTTP: ' . $httpCode;
    }
} else {
    echo 'Error en la solicitud cURL: ' . curl_error($ch);
}

echo $response;

// Cerrar el recurso cURL
curl_close($ch);