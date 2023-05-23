<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/png" href="../../img/image-removebg-preview.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Raleway:wght@200&display=swap">
    <title>Vinos De La Villa</title>
    <!-- Estilos -->
    <link rel="stylesheet" href="../../css/info.css">
    <link rel="stylesheet" href="../../css/Global.css">
    <link rel="stylesheet" href="../../css/Hamburguer.css">
    <link rel="stylesheet" href="../../css/Header.css">
    <link rel="stylesheet" href="../../css/Products.css">
</head>

<body>
    <header class="main-header">
        <div class="container container--flex">
            <div class="main-header_container">
                <a href="../../index.php">
                    <img src="../../img/image-removebg-preview.png" alt="" class="logo">
                </a>
                <div class="centrado1">
                    <h1 class="main-header_title">LOS VINOS</h1>
                    <h2 class="main-header_subtitle"><i>Wine Store</i></h2>
                    <!-- <h2 class="main-header_subtitle">Villa de Leyva, Carrera 9 #11-47 Segundo piso</h2>
                    <p class="main-header_txt">CONTACTANOS (+57) 3219085857 <em class="fas fa-phone"></em></h3> -->
                </div>
                <div class="icono-menu">
                    <img src="../../img/bars-solid.svg" id="icono-menu" alt="">
                </div>
                <div class="cont-menu opacity" id="menu">
                    <ul>
                        <li><a href="../../index.php">Home</a></li>
                        <li><a href="#">Cepas</a></li>
                    </ul>
                </div>
                <!-- Add cart button here -->
            </div>
        </div>
        <!-- <form id="myForm" action="./modulos/consultas-preparadas/consultas-preparadas.php" method="POST">
            <div class="main-header_container">
                <label for="query"></label>
                <input type="search" id="query" name="query" class="main-header_input"
                    placeholder="What product are you looking for?">
                <em class="fas fa-search" id="lupa"></em>
            </div>
        </form> -->
    </header>
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
        // $ProductoEncontrado[] => ([id], [nombre], [variedad], [anada], [bodega], [pais], [region], [precio], [stock], [tipo], [nivel_alcohol], [tipo_barrica], [notas_cata], [temperatura_consumo], [maridaje], [activo], [id_unica], [url_imagen], [busqueda], [paises][pais], [secciones][nombre], [variedades][variedad])
        // Muestra la información del producto
        ?>
        <div class="asasasdasd">
            <div>
                <img src="<?php echo $productoEncontrado['url_imagen']; ?>"
                    alt="<?php echo $productoEncontrado['nombre']; ?>" class="product_img"
                    style="width: 100%; height: 100%;">
            </div>
            <main>
                <div class="asasasdasd">
                    <h1>
                        <?php echo $productoEncontrado['nombre']; ?>
                    </h1>
                </div>
                <div class="asasasdasd">
                    <h2>
                        <?php echo $productoEncontrado['variedades']['variedad']; ?>
                    </h2>
                </div>
                <div class="asasasdasd">
                    <h2>Pais Origen:</h2>
                    <h3>
                        <?php echo $productoEncontrado['paises']['pais']; ?>
                    </h3>
                </div>
                <div class="asasasdasd">
                    <h2>Precio en Dolares:</h2>
                    <h3>$
                        <?php echo $productoEncontrado['precio']; ?> USD
                    </h3>
                </div>
                <div class="asasasdasd">
                    <h2>Precio en Pesos Colombianos:</h2>
                    <h3>$
                        <?php echo number_format($productoEncontrado['precio'] * 4568.38, decimals: 0, decimal_separator: '.', thousands_separator: ','); ?>
                        COP
                    </h3>
                </div>
                <div class="asasasdasd">
                    <h2>Bodega del vino:</h2>
                    <h3>
                        <?php echo $productoEncontrado['bodega']; ?>
                    </h3>
                </div>
                <div class="asasasdasd">
                    <h2>Grados de Alcohol:</h2>
                    <h3>
                        <?php echo $productoEncontrado['nivel_alcohol']; ?>&deg;
                    </h3>
                </div>
                <div class="asasasdasd">
                    <h2>Descripcion:</h2>
                    <h3>
                        <?php echo $productoEncontrado['descripcion']; ?>
                    </h3>
                </div>
                <div class="asasasdasd">
                    <h2>Barrica del Vino:</h2>
                    <h3>
                        <?php echo $productoEncontrado['tipo_barrica']; ?>
                    </h3>
                </div>
                <div class="asasasdasd">
                    <h2>Notas de Cata:</h2>
                    <h3>
                        <?php echo $productoEncontrado['notas_cata']; ?>
                    </h3>
                </div>
                <div class="asasasdasd">
                    <h2>Maridaje:</h2>
                    <h3>
                        <?php echo $productoEncontrado['maridaje']; ?>
                    </h3>
                </div>
                <div class="asasasdasd">
                    <h2>Temperatura Recomendada para Consumo:</h2>
                    <h3>
                        <?php echo $productoEncontrado['temperatura_consumo']; ?>
                    </h3>
                </div>
            </main>
        </div>
        <?php
    } else {
        // Producto no encontrado
        echo '<h3>El producto no existe.</h3>';
    }
    ?>
    <script src="../../js/hamburguer.js"></script>
    <script src="../../js/gridContainer.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>