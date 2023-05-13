<?php
session_start();

require './modulos/consultas-preparadas/consultas-preparadas.php';

$resultado_productos = $_SESSION['resultado_productos'];
$resultado_secciones = $_SESSION['resultado_secciones'];

function get_image($unique_id)
{
    $image_path = 'img/vinos/' . $unique_id . '.png';
    $image_exists = file_exists($image_path) ? $image_path : "img/logo.png";
    return $image_exists;
}

function get_button($isPromotion)
{
    $class = $isPromotion ? 'promotion-btn' : 'product-btn';
    $text = $isPromotion ? 'PROMOCION' : 'COMPRAR';
    return '<a href="" class="' . $class . '"><em class="fas fa-shopping-cart">' . $text . '</em></a>';
}

function get_product($resultado_productos, $x)
{
    $promocion = $resultado_productos["promocion"];
    $categoria = $resultado_productos["categoria"];
    $unique = $resultado_productos["imagen"];
    $nombre = $resultado_productos["nombre_vino"];
    $uva = $resultado_productos["uva"];
    $precio = $resultado_productos["precio_vino"];
    $imagen = get_image($unique);
    $button = get_button($promocion);
    $taza_cambio = 4568.38;
    $precio_cop = $precio * $taza_cambio;

    if ($categoria == $x) {
        return '
        <div class="product">
            <div class="product_description">
                <img src="' . $imagen . '" alt="" class="product_img">
                <h2 class="product_title bold">' . $nombre . '</h2>
                <h2 class="product_description bold">' . $uva . '</h2>
                <h2 class="product_price bold"> $' . number_format($precio_cop, 0, '.', ',') . ' COP </h2>
                ' . $button . '
            </div>
        </div>';
    }
}

function get_section($resultado_secciones, $x, $resultado_productos)
{
    static $i = 1;
    $section = '<h2 class="main-title"><strong>' . $resultado_secciones['nombre'] . '</strong></h2>';
    $section .= '<div class="container-products" id="container' . $i . '">';
    foreach ($resultado_productos as $productos) {
        $section .= get_product($productos, $x);
    }
    $section .= '</div>';
    $i++;
    return $section;
}

function get_all_sections($resultado_secciones, $x, $resultado_productos)
{
    $sections = "";
    foreach ($resultado_secciones as $seccion_productos) {
        if ($seccion_productos["id_unica"] == $x) {
            $sections .= get_section($seccion_productos, $x, $resultado_productos);
        }
    }
    return $sections;
}

function tarjetas($x)
{
    global $resultado_secciones, $resultado_productos;
    $sections = get_all_sections($resultado_secciones, $x, $resultado_productos);
    echo $sections;
}

function tarjetasFin()
{
    global $resultado_secciones;
    $total_secciones = count($resultado_secciones);
    for ($i = 1; $i <= $total_secciones; $i++) {
        echo '<div>';
        tarjetas($i);
        echo '<div class="pagination">';
        echo '<button id="prev-btn' . $i . '">🔙</button>';
        echo '<button id="next-btn' . $i . '">🔜</button>';
        echo '</div>';
        echo '</div>';
    }
}

?>