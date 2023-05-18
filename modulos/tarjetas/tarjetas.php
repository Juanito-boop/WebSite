<?php

require './api/supabaseProductos.php';
require './api/supabaseSecciones.php';

$productos = $data_productos;
$secciones = $data_secciones;

function get_button($isPromotion, $unique)
{
    $class = $isPromotion ? 'promotion-btn' : 'product-btn';
    $text = $isPromotion ? '<p>  PROMOCION</p>' : '<p>  INFORMACION</p>';
    return '<a href="./modulos/detalles/info.php?id=' . $unique . '" class="' . $class . '" alt="' . $text . '">
                <img 
                src="./img/magnifying-glass-plus-solid.svg" 
                style="
                    width: 15px;
                    color: #efb810;
                ">' . $text . '
            </a>';
}

function get_product($producto, $categoriaSeleccionada)
{
    $categoria = $producto['id_categoria'];
    $nombre_vino = $producto['nombre'];
    $precio_vino = $producto['precio'];
    $promocion = $producto['promocion'];
    $unique = $producto['id_unica'];
    $url = $producto['url_imagen'];
    $cepa = $producto['variedades']['variedad'];

    $button = get_button($promocion, $unique);

    $taza_cambio = 4568.38;

    $precio_cop = $precio_vino * $taza_cambio;
    $precio_final = number_format($precio_cop, decimals: 0, decimal_separator: '.', thousands_separator: ',');

    if ($categoria == $categoriaSeleccionada) {
        return '
        <div class="product">
            <div class="product_description">
                <img src="' . $url . '" alt="" class="product_img">
                <h2 class="product_title bold">' . $nombre_vino . '</h2>
                <h2 class="product_description bold">' . $cepa . '</h2>
                <h2 class="product_price bold"> $' . $precio_final . ' COP </h2>
                ' . $button . '
            </div>
        </div>';
    }
}

function get_section($seccion, $seccionSeleccionada, $productos)
{
    static $i = 1;
    $section = '<h2 class="main-title">
                    <strong>
                        ' . $seccion['nombre'] . '
                    </strong>
                </h2>';
    $section .= '<div class="container-products" id="container' . $i . '">';
    foreach ($productos as $producto) {
        $section .= get_product($producto, $seccionSeleccionada);
    }
    $section .= '</div>';
    $i++;
    return $section;
}

function get_all_sections($secciones, $seccionID, $productos)
{
    $sections = "";
    foreach ($secciones as $seccion) {
        if ($seccion["id_unica"] == $seccionID) {
            $sections .= get_section($seccion, $seccionID, $productos);
        }
    }
    return $sections;
}

function tarjetas($seccionID)
{
    global $secciones, $productos;
    $sections = get_all_sections($secciones, $seccionID, $productos);
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