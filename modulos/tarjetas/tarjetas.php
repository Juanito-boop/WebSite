<?php

// require '../../api/supabaseProductos.php';
// require '../../api/supabaseSecciones.php';
require './api/supabaseProductos.php';
require './api/supabaseSecciones.php';

$productos = $data_productos;
$secciones = $data_secciones;

function get_image($unique_id)
{
    $image_path = 'img/vinos/' . $unique_id . '.png';
    return file_exists($image_path) ? $image_path : "img/logo.png";
}

function get_button($isPromotion)
{
    $class = $isPromotion ? 'promotion-btn' : 'product-btn';
    $text = $isPromotion ? 'PROMOCION' : '  INFORMACION';
    return '<a href="" class="' . $class . '"><em class="fas fa-shopping-cart">' . $text . '</em></a>';
}

function get_product($productos, $x)
{
    $categoria = $productos['id_categoria'];
    $nombre_vino = $productos['nombre'];
    $precio_vino = $productos['precio'];
    $promocion = $productos['promocion'];
    $unique = $productos['id_imagen'];
    $cepa = $productos['variedades']['variedad'];

    $button = get_button($promocion);
    $imagen = get_image($unique);

    $taza_cambio = 4568.38;

    $precio_cop = $precio_vino * $taza_cambio;
    $precio_final = number_format($precio_cop, decimals: 0, decimal_separator: '.', thousands_separator: ',');

    if ($categoria == $x) {
        return '
        <div class="product">
            <div class="product_description">
                <img src="' . $imagen . '" alt="" class="product_img">
                <h2 class="product_title bold">' . $nombre_vino . '</h2>
                <h2 class="product_description bold">' . $cepa . '</h2>
                <h2 class="product_price bold"> $' . $precio_final . ' COP </h2>
                ' . $button . '
            </div>
        </div>';
    }
}

function get_section($secciones, $x, $productos)
{
    static $i = 1;
    $section = '<h2 class="main-title">
                    <strong>
                        ' . $secciones['nombre'] . '
                    </strong>
                </h2>';
    $section .= '<div class="container-products" id="container' . $i . '">';
    foreach ($productos as $productos_data) {
        $section .= get_product($productos_data, $x);
    }
    $section .= '</div>';
    $i++;
    return $section;
}

function get_all_sections($secciones, $x, $productos)
{
    $sections = "";
    foreach ($secciones as $seccion_productos) {
        if ($seccion_productos["id_unica"] == $x) {
            $sections .= get_section($seccion_productos, $x, $productos);
        }
    }
    return $sections;
}

function tarjetas($x)
{
    global $secciones, $productos;
    $sections = get_all_sections($secciones, $x, $productos);
    echo $sections;
}

function tarjetasFin()
{
    global $secciones;
    $total_secciones = count($secciones);
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