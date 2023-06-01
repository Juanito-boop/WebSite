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
                    <h1 class="main-header_title">LOSS</h1>
                    <h2 class="main-header_subtitle"><i>Wine Store</i></h2>
                    <h2 class="main-header_subtitle">Villa de Leyva, Carrera 9 #11-47 Segundo piso</h2>
                    <p class="main-header_txt">CONTACTANOS (+57) 3219085857 <em class="fas fa-phone"></em></h3>
                </div>
                <div class="icono-menu">
                    <img src="../../img/bars-solid.svg" id="icono-menu" alt="">
                </div>
                <div class="cont-menu opacity" id="menu">
                    <ul>
                        <li><a href="../../index.php">Home</a></li>
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
    use api\GET\supabaseGetVinos;

    require_once('../../api/GET/supabaseGetVinos.php');

    $supabaseGetVinos = new supabaseGetVinos();
    $dataGetProductos = $supabaseGetVinos->getProductos();

    // Obtén el ID único del producto desde la URL
    $productoID = $_GET['id'];

    // Busca el producto con el ID de imagen correspondiente
    $productoEncontrado = null;
    if (isset($dataGetProductos)) {
        foreach ($dataGetProductos as $producto) {
            if ($producto['id_unica'] == $productoID) {
                $productoEncontrado = $producto;
                break; // Se encontró el producto, salir del bucle
            }
        }
    }

    // Verifica si se encontró el producto
    if ($productoEncontrado !== null) {
        // $ProductoEncontrado[] => ([id], [nombre], [variedad], [anada], [bodega], [pais], [region], [precio], [stock], [tipo], [nivel_alcohol], [tipo_barrica], [notas_cata], [temperatura_consumo], [maridaje], [activo], [id_unica], [url_imagen], [busqueda], [paises][pais], [secciones][nombre], [variedades][variedad])
        // Muestra la información del producto
        ?>
        <div class="asasasdasd">
            <aside>
                <img src="<?php echo $productoEncontrado['url_imagen']; ?>"
                    alt="<?php echo $productoEncontrado['nombre']; ?>" class="product_img"
                    style="width: 100%; height: 100%;">
            </aside>
            <main>
                <h1><label for="nombre-vino">Nombre: </label></h1>
                <p id="nombre-vino">
                    <?php echo $productoEncontrado['nombre']; ?>
                </p>
                <h1><label for="pais-vino">Pais: </label></h1>
                <p id="pais-vino">
                    <?php echo $productoEncontrado['paises']['pais']; ?>
                </p>
                <h1><label for="cepa-vino">Cepa: </label></h1>
                <p id="cepa-vino">
                    <?php echo $productoEncontrado['variedades']['variedad']; ?>
                </p>
                <h1><label for="precio-vino">Precio: </label></h1>
                <p id="precio-vino">
                    <?php echo $productoEncontrado['precio']; ?>
                </p>
                <h1><label for="">Bodega: </label></h1>
                <p id="">
                    <?php echo $productoEncontrado['bodega']; ?>
                </p>
                <h1><label for="">Nivel alcohol: </label></h1>
                <p id="">
                    <?php echo $productoEncontrado['nivel_alcohol']; ?>&deg;
                </p>
                <h1><label for="">Descripcion: </label></h1>
                <p id="">
                    <?php echo $productoEncontrado['descripcion']; ?>
                </p>
                <h1><label for="">Barrica: </label></h1>
                <p id="">
                    <?php echo $productoEncontrado['tipo_barrica']; ?>
                </p>
                <h1><label for="">Notas de cata: </label></h1>
                <p id="">
                    <?php echo $productoEncontrado['notas_cata']; ?>
                </p>
                <h1><label for="">Maridaje: </label></h1>
                <p id="">
                    <?php echo $productoEncontrado['maridaje']; ?>
                </p>
                <h1><label for="">Temperatura recomendada para consumo: </label></h1>
                <p id="">
                    <?php echo $productoEncontrado['temperatura_consumo']; ?>
                </p>
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