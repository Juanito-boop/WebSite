<?php
// Importamos el archivo con las constantes para conectarnos a la base de datos
require('../../config/database.php');
// Conectamos a la base de datos utilizando PDO
$conexion = new PDO("pgsql:host=" . HOST . ";port=" . PORT . ";dbname=" . DBNAME, USER, PASSWORD);

// Obtener el valor de búsqueda de la URL
$searchValue = $_GET['q'];

$sentencia_productos = $conexion->prepare(
    "SELECT 
        paises.pais AS pais,
        secciones.nombre AS seccion,
        variedades.variedad AS uva, vinos.id as id_vino,
        vinos.id_categoria as categoria,
        vinos.id_imagen as imagen,
        vinos.nombre as nombre_vino,
        vinos.precio as precio_vino,
        vinos.promocion as promocion
    FROM vinos 
    INNER JOIN variedades ON variedades.id = vinos.variedad 
    INNER JOIN paises ON vinos.pais = paises.id 
    INNER JOIN secciones ON vinos.id_categoria = secciones.id
    WHERE 
    pais = ? OR uva = ? OR nombre_vino = ?"
);
$sentencia_productos->execute([$searchValue, $searchValue, $searchValue]);
if ($sentencia_productos->rowCount() === 0) {
    $sentencia_productos = $conexion->prepare(
        "SELECT 
        paises.pais AS pais,
        secciones.nombre AS seccion,
        variedades.variedad AS uva,
        vinos.id as id_vino,
        vinos.id_categoria as categoria,
        vinos.id_imagen as imagen,
        vinos.nombre as nombre_vino,
        vinos.precio as precio_vino,
        vinos.promocion as promocion
    FROM vinos 
    INNER JOIN variedades ON variedades.id = vinos.variedad 
    INNER JOIN paises ON vinos.pais = paises.id 
    INNER JOIN secciones ON vinos.id_categoria = secciones.id"
    );
    print_r($sentencia_productos);
} else {
    $resultado = $sentencia_productos->fetchAll();
    return $resultado;
}