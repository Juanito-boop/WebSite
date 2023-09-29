<?php

$urlImg = $_POST['imageUrl'];

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
