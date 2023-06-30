<?php
use Dotenv\Dotenv as Dotenv;

require_once '../../vendor/autoload.php';

$dotenv = Dotenv::createUnsafeImmutable('../../');
$dotenv->load();

// Obtén el ID único del producto desde la URL
$productoID = $_GET['id'];

// Variables para asignar los valores
$nombre = "";
$pais = "";
$cepa = "";
$precio = "";
$bodega = "";
$nivel_alcohol = "";
$descripcion = "";
$tipo_barrica = "";
$notas_cata = "";
$maridaje = "";
$temperatura_consumo = "";
$imagen = "";

//cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://' . $_ENV['ID_PROJECT'] . '.supabase.co/rest/v1/vinos?id_unica=eq.' . $productoID . '&select=id,nombre,anada,bodega,region,precio,stock,tipo,nivel_alcohol,tipo_barrica,descripcion,notas_cata,temperatura_consumo,activo,id_unica,url_imagen,promocion,busqueda,maridaje,pais,paises(pais),id_categoria,secciones(nombre),variedad,variedades(variedad)');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'apikey: ' . $_ENV['APIKEY'],
    'Authorization: Bearer ' . $_ENV['APIKEY'],
]);
$respuestaBusqueda = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if ($httpCode == 200) {
    $productosEncontrados = json_decode($respuestaBusqueda, true);
    $productoEncontrado = $productosEncontrados[0];

    // Asignación de valores
    $nombre = $productoEncontrado['nombre'];
    $pais = $productoEncontrado['paises']['pais'];
    $cepa = $productoEncontrado['variedades']['variedad'];
    $precio = $productoEncontrado['precio'];
    $bodega = $productoEncontrado['bodega'];
    $nivel_alcohol = $productoEncontrado['nivel_alcohol'];
    $descripcion = $productoEncontrado['descripcion'];
    $tipo_barrica = $productoEncontrado['tipo_barrica'];
    $notas_cata = $productoEncontrado['notas_cata'];
    $maridaje = $productoEncontrado['maridaje'];
    $temperatura_consumo = $productoEncontrado['temperatura_consumo'];
    $imagen = $productoEncontrado['url_imagen'];

    if ($productoEncontrado === null) {
        echo "<script> alert('Producto no encontrado')</script>";
    }
} else {
    echo "<script> alert('Producto no disponible')</script>";
}
curl_close($ch);
?>

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
                    <h2 class="main-header_subtitle">Villa de Leyva, Carrera 9 #11-47 Segundo piso</h2>
                    <p class="main-header_txt">CONTACTANOS (+57) 3219085857 <em class="fas fa-phone"></em></p>
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
    </header>

    <div class="asasasdasd">
        <aside>
            <img src="<?php echo $imagen; ?>" alt="<?php echo $nombre; ?>" class="product_img"
                style="width: 100%; height: 100%;">
        </aside>
        <main Style="background-color: #7f1a77;border-radius: 10px;">
            <h1><label for="nombre-vino">Nombre: </label></h1>
            <p id="nombre-vino">
                <?php echo $nombre; ?>
            </p>
            <h1><label for="pais-vino">País: </label></h1>
            <p id="pais-vino">
                <?php echo $pais; ?>
            </p>
            <h1><label for="cepa-vino">Cepa: </label></h1>
            <p id="cepa-vino">
                <?php echo $cepa; ?>
            </p>
            <h1><label for="precio-vino">Precio: </label></h1>
            <p id="precio-vino">
                <?php echo $precio; ?>
            </p>
            <h1><label for="bodega-vino">Bodega: </label></h1>
            <p id="bodega-vino">
                <?php echo $bodega; ?>
            </p>
            <h1><label for="nivel-alcohol-vino">Nivel alcohol: </label></h1>
            <p id="nivel-alcohol-vino">
                <?php echo $nivel_alcohol; ?>&deg;
            </p>
            <h1><label for="descripcion-vino">Descripción: </label></h1>
            <p id="descripcion-vino">
                <?php echo $descripcion; ?>
            </p>
            <h1><label for="barrica-vino">Barrica: </label></h1>
            <p id="barrica-vino">
                <?php echo $tipo_barrica; ?>
            </p>
            <h1><label for="notas-cata-vino">Notas de cata: </label></h1>
            <p id="notas-cata-vino">
                <?php echo $notas_cata; ?>
            </p>
            <h1><label for="maridaje-vino">Maridaje: </label></h1>
            <p id="maridaje-vino">
                <?php echo $maridaje; ?>
            </p>
            <h1><label for="temperatura-consumo-vino">Temperatura recomendada para consumo: </label></h1>
            <p id="temperatura-consumo-vino">
                <?php echo $temperatura_consumo; ?>
            </p>
        </main>
    </div>

    <script src="../../js/hamburguer.js"></script>
    <script src="../../js/gridContainer.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>