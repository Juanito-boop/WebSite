<?php
session_start();

require './modulos/consultas-preparadas/consultas-preparadas.php';

$resultado_productos = $_SESSION['resultado_productos'];
$resultado_secciones = $_SESSION['resultado_secciones'];

// $resultado_productos = [];
// $resultado_secciones = [];

/** 
 * sin parametros de busqueda
 * ["pais_vino"], ["seccion_vino"], ["uva_vino"], ["id_vino"], ["categoria_vino"], ["imagen_vino"], ["nombre_vino"], ["precio_vino"], ["promocion"]
 * 
 * con parametros de busqueda
 * ["pais_vino"], ["seccion_vino"], ["uva_vino"], ["id_vino"], ["imagen_vino"], ["nombre_vino"], ["precio_vino"], ["promocion"], ["busqueda_vino"] 
 */

function get_image($unique_id)
{
    $image_path = 'img/vinos/' . $unique_id . '.png';
    $image_exists = file_exists($image_path) ? $image_path : "img/logo.png";
    return $image_exists;
}

function get_button($isPromotion, $unique_id)
{
    $class = $isPromotion ? 'promotion-btn' : 'product-btn';
    $text = $isPromotion ? ' PROMOCION' : ' COMPRAR';
    return '
    <a href="details.php" class="' . $class . '" onclick=""><i class="fa-solid fa-cart-plus"> AGREGAR </i></a>
    <a class="' . $class . '" onclick=""><i class="fa-solid fa-cart-shopping">' . $text . '</i></a>
    ';
}

function get_product($resultado_productos, $x)
{
    $categoria = $resultado_productos["categoria_vino"];
    $nombre = $resultado_productos["nombre_vino"];
    $precio = $resultado_productos["precio_vino"];
    $promocion = $resultado_productos["promocion"];
    $unique = $resultado_productos["imagen_vino"];
    $uva = $resultado_productos["uva_vino"];

    $taza_cambio = 4568.38;

    $button = get_button($promocion, $unique);
    $imagen = get_image($unique);
    $precio_cop = $precio * $taza_cambio;

    if ($categoria == $x) {
        return '
        <div class="product">
            <div class="product_description">
                <img src="' . $imagen . '" alt="" class="product_img">
                <h2 class="product_title bold">' . $nombre . '</h2>
                <h2 class="product_description bold">' . $uva . '</h2>
                <h2 class="product_price bold"> $' . number_format($precio_cop, 0, '.', ',') . ' COP </h2>
            </div>
            ' . $button . '
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
        $id_unica = $seccion_productos["id_unica"];
        if ($id_unica == $x) {
            $sections .= get_section($seccion_productos, $id_unica, $resultado_productos);
        }
    }
    return $sections;
}

function get_search_sections($resultado_secciones, $resultado_productos)
{
    $sections = "";
    foreach ($resultado_secciones as $seccion_productos) {
        $id_busqueda = $seccion_productos["id_unica"];
        if ($id_busqueda == 4) {
            $sections .= get_section($seccion_productos, $id_busqueda, $resultado_productos);
        }
    }
    return $sections;
}

function tarjetasAll($x)
{
    global $resultado_secciones, $resultado_productos;
    $section_all = get_all_sections($resultado_secciones, $x, $resultado_productos);
    echo $section_all;
}

function tarjetasSearch()
{
    global $resultado_secciones, $resultado_productos;
    $seccion_search = get_search_sections($resultado_secciones, $resultado_productos);
    if (!empty($seccion_search)) {
        echo $seccion_search;
        echo '<div class="pagination">';
        echo '<button id="prev-btn">🔙</button>';
        echo '<button id="next-btn">🔜</button>';
        echo '</div>';
    }
}

function tarjetasFin()
{
    global $resultado_secciones;
    $total_secciones = count($resultado_secciones);
    for ($i = 1; $i <= $total_secciones; $i++) {
        echo '<div>';
        tarjetasSearch();
        tarjetasAll($i);
        echo '<div class="pagination">';
        echo '<button id="prev-btn' . $i . '">🔙</button>';
        echo '<button id="next-btn' . $i . '">🔜</button>';
        echo '</div>';
        echo '</div>';
    }
}

?>