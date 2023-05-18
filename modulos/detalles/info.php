<?php
$apiProductosFilePath = realpath(
    path: __DIR__ .
    DIRECTORY_SEPARATOR . '..' .
    DIRECTORY_SEPARATOR . '..' .
    DIRECTORY_SEPARATOR . 'api' .
    DIRECTORY_SEPARATOR . 'supabaseProductos.php'
);
require_once($apiProductosFilePath);
// Obtén el ID único del producto desde la URL
$productoID = $_GET['id'];

// Busca el producto con el ID de imagen correspondiente
$productoEncontrado = null;
foreach ($data_productos as $producto) {
    if ($producto['id_unica'] == $productoID) {
        $productoEncontrado = $producto;
        break; // Se encontró el producto, salir del bucle
    }
}

// Verifica si se encontró el producto
if ($productoEncontrado !== null) {
    // Muestra la información del producto
    echo '<h1>' . $productoEncontrado['nombre'] . '</h1>
          <h2>' . $productoEncontrado['variedades']['variedad'] . '</h2>
          <h2>' . $productoEncontrado['descripcion'] . '</h2>';
    // Muestra más detalles del producto según tu estructura de datos
} else {
    // Producto no encontrado
    echo '<p>El producto no existe.</p>';
}
?>