<?php

$nombreArchivo = $_FILES['imagenes']['name'];
$tipoArchivo = $_FILES['imagenes']['type'];
$rutaTemporal = $_FILES['imagenes']['tmp_name'];

$urlImg = "https://npuxpuelimayqrsmzqur.supabase.co/storage/v1/object/images/$nombreArchivo";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $urlImg);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'apikey: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6Im5wdXhwdWVsaW1heXFyc216cXVyIiwicm9sZSI6ImFub24iLCJpYXQiOjE2ODU5MzIyOTMsImV4cCI6MjAwMTUwODI5M30.XBKmo8wZRwFviHAgQjgDbbE3D_vmaeqvEP4mKi6W3bU',
    'Content-Type: ' . $tipoArchivo,
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, '@' . $rutaTemporal);
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

curl_close($ch);
if ($httpCode == 200 || $httpCode == 201) {
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
    $uniqueId = (int) crc32(uniqid());
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
        'url_imagen' => $imageUrl,
        'promocion' => $promocion,
        'busqueda' => $busqueda,
    ];
    var_dump($datosVino);

} else {
    echo "<script>alert('Error al subir la imagen' $httpCode);window.location.href = 'formulario-nuevo-producto.php';</script>";
}
