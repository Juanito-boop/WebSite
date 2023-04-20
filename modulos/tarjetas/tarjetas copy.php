<?php
include_once './config/database.php';
$obj = new Connection();
$conn = $obj->Conexion();


$sentencia_productos = $conn->query("SELECT vinos.*, variedades.variedad AS variedad_uva, paises.pais AS pais_origen, secciones.nombre AS nombre_seccion, secciones.id AS seccion FROM vinos INNER JOIN variedades ON variedades.id = vinos.variedad INNER JOIN paises ON vinos.pais = paises.id INNER JOIN secciones ON vinos.id_categoria = secciones.id WHERE vinos.activo = true ORDER BY vinos.id ASC");

$sentencia_secciones = $conn->query("SELECT * FROM secciones WHERE activo = true");

$sentencia_productos->execute();
$sentencia_secciones->execute();

$resultado_productos = $sentencia_productos->fetchAll(PDO::FETCH_ASSOC);
$resultado_secciones = $sentencia_secciones->fetchAll(PDO::FETCH_ASSOC);

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

function get_product($_Productos, $x)
{
    $_Promocion = $_Productos['promocion'];
    $categoria = $_Productos['id_categoria'];
    $unique = $_Productos['id_imagen'];
    $imagen = get_image($unique);
    $button = get_button($_Promocion);
    $taza_cambio = 4568.38;
    $_Precio_cop = $_Productos['precio'] * $taza_cambio;

    if ($categoria == $x) {
        return '<div class="product">
              <div class="product_description">
                <img src="' . $imagen . '" alt="" class="product_img">
                <h2 class="product_title bold">' . $_Productos['nombre'] . '</h2>
                <h2 class="product_description bold">' . $_Productos['variedad_uva'] . '</h2>
                <h2 class="product_price bold"> $' . number_format($_Precio_cop, 0, '.', ',') . ' COP </h2>
                ' . $button . '
              </div>
            </div>';
    }
}

function get_section($seccion_productos, $x, $resultado_productos)
{
    static $i = 1;
    $section = '<h2 class="main-title"><strong>' . $seccion_productos['nombre'] . '</strong></h2>';
    $section .= '<div class="container-products" id="container' . $i . '">';
    foreach ($resultado_productos as $_Productos) {
        $section .= get_product($_Productos, $x);
    }
    $section .= '</div>';
    $i++;
    return $section;
}

function get_all_sections($resultado_secciones, $x, $resultado_productos)
{
    $sections = "";
    foreach ($resultado_secciones as $seccion_productos) {
        if ($seccion_productos['id_unica'] == $x) {
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
?>