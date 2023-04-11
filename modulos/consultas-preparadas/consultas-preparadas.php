<?php
// Importamos el archivo con las constantes para conectarnos a la base de datos
require('../../config/database.php');
// Conectamos a la base de datos utilizando PDO
$conexion = new PDO("pgsql:host=" . HOST . ";port=" . PORT . ";dbname=" . DBNAME, USER, PASSWORD);

$_sentencia_productos = $conexion->query("SELECT * FROM prueba WHERE activo = true");
if ($_sentencia_productos != null) {
    return $_sentencia_productos;
} else {
    echo "no";
}