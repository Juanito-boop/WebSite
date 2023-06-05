<?php

$curl = curl_init();

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
$promocion = isset($_POST['promocion']) ? true : false;
$busqueda = 4;

$refId = 'hijaeegxjbuivzckpijg';
$apiKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6Im5wdXhwdWVsaW1heXFyc216cXVyIiwicm9sZSI6ImFub24iLCJpYXQiOjE2ODU5MzIyOTMsImV4cCI6MjAwMTUwODI5M30.XBKmo8wZRwFviHAgQjgDbbE3D_vmaeqvEP4mKi6W3bU';
$bucketId = 'imagenes-vino';

if (isset($_POST['imagenes'])) {
    $fileName = $_POST['imagenes'];
    $urlProductos = 'https://npuxpuelimayqrsmzqur.supabase.co/rest/v1/vinos';
    $imageUrl = "http://hijaeegxjbuivzckpijg.supabase.co/storage/v1/object/public/$bucketId/$fileName";
    $datosVino = [
        'nombre' => $nombreVino, 'variedad' => $variedad, 'anada' => $anno,
        'bodega' => $bodega, 'pais' => $pais, 'region' => $region,
        'precio' => $precio, 'stock' => $stock, 'tipo' => $tipos,
        'nivel_alcohol' => $nivelAlcohol, 'tipo_barrica' => $tipoBarrica, 'descripcion' => $descripcion,
        'notas_cata' => $notasCata, 'temperatura_consumo' => $temperaturaConsumo, 'maridaje' => $maridaje,
        'id_categoria' => $idCategoria, 'activo' => $activo, 'id_unica' => $uniqueId,
        'url_imagen' => $imageUrl, 'promocion' => $promocion, 'busqueda' => $busqueda,
    ];
    var_dump($datosVino);
    curl_setopt_array(
        $curl,
        options: [
            CURLOPT_URL => $urlProductos,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '',
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer $apiKey",
                "apikey: $apiKey",
                'Content-Type: application/json',
                'Prefer: return=minimal',
            ],
        ]
    );
    $response = curl_exec($curl);
    $httpCode = curl_getinfo($curl, option: CURLINFO_HTTP_CODE);
    curl_close($curl);

    if ($httpCode == 200 || $httpCode == 201) {
        echo '<script>alert("Registro exitoso.");window.location.href = "formulario-nuevo-producto.php";</script>';
    }
} else {
    echo '<script>alert("No hay imagen");window.location.href = "formulario-nuevo-producto.php";</script>';
}
