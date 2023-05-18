<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/png" href="./img/image-removebg-preview.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Raleway:wght@200&display=swap">
    <title>Vinos De La Villa</title>
    <!-- Estilos -->
    <link rel="stylesheet" href="../../css/aside.css">
    <link rel="stylesheet" href="../../css/Global.css">
    <link rel="stylesheet" href="../../css/Hamburguer.css">
    <link rel="stylesheet" href="../../css/Header.css">
    <link rel="stylesheet" href="../../css/Products.css">
</head>

<body>
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
        echo '<div class="contenedor_principal">
                <aside>
                    <img src="' . $productoEncontrado['url_imagen'] . '" alt="' . $productoEncontrado['nombre'] . '" class="product_img">
                </aside>
                <main>
                    <div class="container">
                        <h1>' . $productoEncontrado['nombre'] . '</h1>
                        <h2>' . $productoEncontrado['variedades']['variedad'] . '</h2>
                        <h2>' . $productoEncontrado['descripcion'] . '</h2>
                        <h3>$' . $productoEncontrado['precio'] . ' USD</h3>
                        <h3>$' . number_format($productoEncontrado['precio'] * 4568.38, decimals: 0, decimal_separator: '.', thousands_separator: ',') . ' COP</h3>
                    </div>
                </main>';
        // Muestra más detalles del producto según tu estructura de datos
    } else {
        // Producto no encontrado
        echo '<p>El producto no existe.</p>';
    }
    ?>
</body>

</html>