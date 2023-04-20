<?php
// Importamos el archivo con las constantes para conectarnos a la base de datos
require('../../config/database.php');
// Conectamos a la base de datos utilizando PDO
$conexion = new PDO("pgsql:host=" . HOST . ";port=" . PORT . ";dbname=" . DBNAME, USER, PASSWORD);

$sentencia_productos = $conexion->query(
    "SELECT vinos.*, variedades.variedad AS variedad_uva, paises.pais AS pais_origen, secciones.nombre AS nombre_seccion FROM vinos INNER JOIN variedades ON variedades.id = vinos.variedad INNER JOIN paises ON vinos.pais = paises.id INNER JOIN secciones ON vinos.id_categoria = secciones.id ORDER BY vinos.id ASC"
);
if ($sentencia_productos->rowCount() == 0) {
    echo ("No");
} else {
    echo ("si");
}